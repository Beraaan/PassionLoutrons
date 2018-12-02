<?php

require_once (File::build_path(array("lib", "File.php")));
require_once File::build_path(array("model", "Model.php"));

class ModelUtilisateur extends Model {

    private $login;
    private $nom;
    private $prenom;
    private $ville;
    private $mail;
    private $adresse;
    private $password;
    protected static $object = 'utilisateur';
    protected static $primary = 'login';

    // Constructeur
    public function __construct($login = NULL, $password = NULL, $nom = NULL, $prenom = NULL, $ville = NULL, $adresse = NULL, $mail = NULL) {
        if (!is_null($login) && !is_null($password) && !is_null($nom) && !is_null($prenom) && !is_null($ville) && !is_null($mail) && !is_null($adresse)) {
            $this->login = $login;
            $this->password = $password;
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->ville = $ville;
            $this->adresse = $adresse;
            $this->mail = $mail;
        }
    }

    // Getters
    public function getLogin() {
        return $this->login;
    }

    public function getNom() {
        return $this->nomUtilisateur;
    }

    public function getPrenom() {
        return $this->prenomUtilisateur;
    }

    public function getVille() {
        return $this->villeU;
    }

    public function getMail() {
        return $this->mailU;
    }

    public function getAdresse() {
        return $this->adresse;
    }

    // Setters
    public function setLogin($log) {
        $this->login = $log;
    }

    public function setNom($nouveauNom) {
        $this->nom = $nouveauNom;
    }

    public function setPrenom($nouveauPrenom) {
        $this->prenom = $nouveauPrenom;
    }

    public function setVille($nouvelleVille) {
        $this->ville = $nouvelleVille;
    }

    public function setMail($nouveauMail) {
        $this->mail = $nouveauMail;
    }

    public function setAdresse($nouvelleAdresse) {
        $this->adresse = $nouvelleAdresse;
    }
    
    public function save() {
        $sql = "INSERT INTO utilisateur (`login`, `password`, `nomUtilisateur`, `prenomUtilisateur`, `villeU`, `adresse`, `mailU`)
                VALUES (:login, :password, :nom, :prenom, :ville, :adresse, :mail)";

        try {
            $rep_prep = Model::$pdo->prepare($sql);
        } catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage();
            } else {
                echo 'Une erreur est survenue (PDO)';
            }
            die();
        }

        $values = array(
            "login" => $this->login,
            "password" => $this->password,
            "nom" => $this->nom,
            "prenom" => $this->prenom,
            "ville" => $this->ville,
            "adresse" => $this->adresse,
            "mail" => $this->mail);
        
        $rep_prep->execute($values);
    }
    
    public static function update($data) {
        $sql = "UPDATE `utilisateur` SET `nomUtilisateur`=:nom, `prenomUtilisateur`=:prenom, `villeU`=:ville, `adresse`=:adresse, `mailU`=:mail WHERE login=:login";

        try {
            $req_prep = Model::$pdo->prepare($sql);
        } catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage();
            } else {
                echo 'Une erreur est survenue (PDO)';
            }
            die();
        }

        $values = array(
            "login" => $data['login'],
            "nom" => $data['nom'],
            "prenom" => $data['prenom'],
            "ville" => $data['ville'],
            "adresse" => $data['adresse'],
            "mail" => $data['mail']
        );

        $req_prep->execute($values);
    }
    
    public static function getUtilisateurByLogin($login) {
        $sql = "SELECT * FROM utilisateur WHERE login=:nom_tag";
        // Préparation de la requête

        try {
            $req_prep = Model::$pdo->prepare($sql);
        } catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage();
            } else {
                echo 'Une erreur est survenue (PDO)';
            }
            die();
        }

        $values = array(
            "nom_tag" => $login,
                //nomdutag => valeur, ...
        );
        // On donne les valeurs et on exécute la requête	 
        $req_prep->execute($values);

        // On récupère les résultats comme précédemment
        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelUtilisateur');
        $tab_util = $req_prep->fetchAll();
        // Attention, si il n'y a pas de r�sultats, on renvoie false
        if (empty($tab_util))
            return false;
        return $tab_util[0];
    }
    
    public static function checkPassword($login,$mot_de_passe_chiffre) {
        $sql = "SELECT COUNT(*)"
                . " FROM utilisateur "
                . "WHERE login=:login_tag"
                . " AND password = :password_tag";
                    
        try {
            $req_prep = Model::$pdo->prepare($sql);
        } catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage();
            } else {
                echo 'Une erreur est survenue (PDO)';
            }
            die();
        }
                
        $values = array(
            "login_tag" => $login,
            "password_tag" => $mot_de_passe_chiffre,
        );
        
        $req_prep->execute($values);

        $nb = $req_prep->fetchAll();
  
        if ($nb == 1)
            return true;
        return false;
    }

}
