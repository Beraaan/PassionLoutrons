<?php

//require_once '/../lib/File.php';
require_once File::build_path(array("model", "ModelUtilisateur.php")); // chargement du modèle
require_once File::build_path(array("lib", "Security.php"));
require_once File::build_path(array("lib", "Session.php"));
require_once File::build_path(array("controller", "routeur.php"));

class ControllerUtilisateur {

    protected static $object = 'utilisateur';

    public static function readAll() {
        $view = 'list';
        $pagetitle = 'Plein d\'ut-uts';
        $tab_u = ModelUtilisateur::selectAll();     //appel au modèle pour gerer la BD
        require (File::build_path(array("view", "view.php")));  //redirige vers la vue
    }

    public static function read($primary) {
        $view = 'profil';
        $pagetitle = 'Ce zutzut !';
        $u = ModelUtilisateur::select($primary);
        if (empty($u))
            require (File::build_path(array("view", $object, "error.php")));
        else {
            require (File::build_path(array("view", "view.php")));
        }
    }
    
    public static function create() {
        $view = 'create';
        $pagetitle = 'Rejoignez-nouus !';
        require (File::build_path(array("view", "view.php")));  //redirige vers la vue
    }
    
    public static function created($login, $password, $nom, $prenom, $ville, $adresse, $mail) {
        if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            echo 'Mail invalide';
            self::create();
        }
        else {
            if (ModelUtilisateur::getUtilisateurByLogin($login)) {
                echo 'Le login est déjà pris.';
                self::create();
            }
            else {
                $view = 'created';
                $pagetitle = 'Inscription réussie !';
                $password_chiffrer = Security::chiffrer($password);
                $nonce = Security::generateRandomHex();
                $u = new ModelUtilisateur($login, $password_chiffrer, $nom, $prenom, $ville, $adresse, $mail, $nonce);
                $u->save();
                $mail_message = 'Bonjour, voici le lien d\'activation: http://webinfo.iutmontp.univ-montp2.fr/~laisnev/PassionLoutrons/index.php?controller=utilisateur&action=validate&login='.rawurlencode($u->getLogin()).'&nonce='.rawurlencode($u->getNonce());
                mail($mail, "Passion Loutrons", $mail_message);
                require (File::build_path(array("view", "view.php")));
            }
        }
    }
    
    public static function update($login) {
        if (Session::is_user($login) || Session::is_admin()) {
            $view = 'update';
            $pagetitle = 'Changer utilisateur !';
            $u = ModelUtilisateur::getUtilisateurByLogin($login);
             require (File::build_path(array("view", "view.php"))); 
        }
        else {
            self::connect();
        }    
    }
    
    public static function updated() {
        if (Session::is_user(myGet('pkey')) || Session::is_admin()) {
            $view = 'updated';
            $pagetitle = 'Yeesss CONGRATS';

            $data = array(
                "login" => myGet('pkey'),
                "nom" => myGet('nom'),
                "prenom" => myGet('prenom'),
                "ville" => myGet('ville'),
                "adresse" => myGet('adresse'),
                "mail" => myGet('mail'),
                );
            
                if (!is_null(myGet('admin'))) {
                    $data['admin'] = myGet('admin');
                }
            
                ModelUtilisateur::update($data);
                $tab_u = ModelUtilisateur::selectAll();
                require File::build_path(array("view", "view.php"));
        }
        else {
            self::connect();
        }    
    }
    
    public static function delete($pkey, $pvalue) {
        if (Session::is_user(myGet('pvalue')) || Session::is_admin()) {
            Model::delete(self::$object, $pkey, $pvalue);
            $view = 'deleted';
            $pagetitle='Utilisateur supprimé';
            if (Session::is_user(myGet('pvalue'))) {
                session_unset();     // unset $_SESSION variable for the run-time 
                session_destroy();   // destroy session data in storage
                setcookie(session_name(),'',time()-1);
            }
            require File::build_path(array("view", "view.php")); 
        }
        else {
            self::connect();
        }
    }
    
    public static function error() {
        $view = 'error';
        $pagetitle = 'Flute !';
        require(File::build_path(array('view', 'view.php')));
    }
    
    public static function connect() {
        $view = 'connect';
        $pagetitle = 'Connexion';
        require (File::build_path(array("view", "view.php")));  //redirige vers la vue
    }
    
    public static function connected() {    
        $mdp_chiffre = Security::chiffrer(myGet('password'));
        if (ModelUtilisateur::checkPassword(myGet('login'), $mdp_chiffre)) {
            if (ModelUtilisateur::nonceIsNull(myGet('login'))) {
                $view = 'connected';
                $pagetitle = 'Connecté !';
                $_SESSION['login'] = myGet('login');
                if (ModelUtilisateur::checkAdmin($_SESSION['login'])) {
                    $_SESSION['admin'] = true;
                }
                else $_SESSION['admin'] = false;

                require (File::build_path(array("view", "view.php")));  
            }
            else {
                echo 'Connexion échouée: mail non validé';
                self::connect();
            }   
        }
        else {
            echo 'Connexion échouée: mauvais identifiants';
            self::connect();
        }   
    }
    
    public static function deconnect() {
        $view = 'deconnect';
        $pagetitle = 'Au revoooaaar';
        session_unset();     // unset $_SESSION variable for the run-time 
        session_destroy();   // destroy session data in storage
        setcookie(session_name(),'',time()-1);
        require(File::build_path(array("view", "view.php")));
    }
    
    public static function validate() {
        $login = myGet('login');
        $nonce = myGet('nonce');
        if (!ModelUtilisateur::getUtilisateurByLogin($login)) {
            $view = 'error';
            $pagetitle = 'Login invalide';
            require(File::build_path(array("view", "view.php")));
        }
        else {
            if (ModelUtilisateur::nonceValide($login, $nonce)) {
                ModelUtilisateur::setNonceNull($login);
                $view = 'validate';
                $pagetitle = 'Mail validé !';
                require(File::build_path(array("view", "view.php")));
            }
            else {
                $view = 'error';
                $pagetitle = 'Rip';
                require(File::build_path(array("view", "view.php")));
            }
        }    
    }
}
