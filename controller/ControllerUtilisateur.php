<?php

//require_once '/../lib/File.php';
require_once File::build_path(array("model", "ModelUtilisateur.php")); // chargement du modèle

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
    
    public static function created($login, $nom, $prenom, $ville, $adresse, $mail) {
        $view = 'created';
        $pagetitle = 'Inscription réussie !';
        $u = new ModelUtilisateur($login, $nom, $prenom, $ville, $adresse, $mail);
        $u->save();
        require (File::build_path(array("view", "view.php")));
    }
    
    public static function update($login) {
        $view = 'update';
        $pagetitle = 'Changer utilisateur !';
        $v = ModelUtilisateur::getUtilisateurByLogin($login);
        require (File::build_path(array("view", "view.php"))); 
    }
    
    public static function updated() {
        $view = 'updated';
        $pagetitle = 'Yeesss CONGRATS';
        $data = array(
            "login" => $_GET['login'],
            "nom" => $_GET['nom'],
            "prenon" => $_GET['prenom'],
            "ville" => $_GET['ville'],
            "adresse" => $_GET['adresse'],
            "mail" => $_GET['mail'],
        );
        ModelUtilisateur::update($data);
        $tab_v = ModelUtilisateur::selectAll();
        require File::build_path(array("view", "view.php"));
    }
    
    public static function error() {
        $view = 'error';
        $pagetitle = 'Flute !';
        require(File::build_path(array('view', 'view.php')));
    }
}