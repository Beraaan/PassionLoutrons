<?php

require_once (File::build_path(array("lib", "File.php")));
require_once File::build_path(array("model", "Model.php"));

class ModelVeterinaire extends Model {

    private $login;
    private $nom;
    private $prenom;
    private $ville;
    private $mail;
    private $adresse;
    private $telephone;
    protected static $object = 'veterinaire';
    protected static $primary = 'login';

    // Constructeur
    public function __construct($login = NULL, $nom = NULL, $prenom = NULL, $ville = NULL, $telephone = NULL, $adresse = NULL,  $mail = NULL) {
        if (!is_null($login) && !is_null($nom) && !is_null($prenom) && !is_null($ville) && !is_null($mail) && !is_null($adresse) && !is_null($telephone)) {
            $this->login = $login;
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->ville = $ville;
            $this->telephone= $telephone;
            $this->adresse = $adresse;
            $this->mail = $mail;
        }
    }

    // Getters
    public function getLogin() {
        return $this->login;
    }

    public function getNom() {
        return $this->nomV;
    }

    public function getPrenom() {
        return $this->prenomV;
    }

    public function getVille() {
        return $this->ville;
    }

    public function getMail() {
        return $this->mailV;
    }

    public function getAdresse() {
        return $this->adresse;
    }

    public function getTelephone() {
        return $this->telephone;
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

    public function setTelephone($nouveauTelephone) {
        $this->telephone = $nouveauTelephone;
    }
    
    public function save() {
        $sql = "INSERT INTO veterinaire (`login`, `nomV`, `prenomV`, `ville`, `telephone`, `adresse`, `mailV`)
                VALUES (:login, :nom, :prenom, :ville, :telephone, :adresse, :mail)";

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
            "nom" => $this->nom,
            "prenom" => $this->prenom,
            "telephone" => $this->telephone,
            "ville" => $this->ville,
            "adresse" => $this->adresse,
            "mail" => $this->mail);
        

        $rep_prep->execute($values);
    }
    
    public static function update($data) {
        $sql = "UPDATE `veterinaire` SET `nom`=:nom,`prenom`=:prenom, `telephone`=:telephone, `ville`=:ville, `adresse`=:adresse, `mail`=:mail WHERE login = :login";

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
            "login" => $data['login'],
            "nom" => $data['nom'],
            "prenon" => $data['prenom'],
            "ville" => $data['ville'],
            "adresse" => $data['adresse'],
            "mail" => $data['mail'],
            "telephone" => $data['telephone'],
        );

        $rep_prep->execute($values);
    }
    
    public static function getVeterinaireByLogin($login) {
        $sql = "SELECT * FROM veterinaire WHERE login=:nom_tag";
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
        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelVeterinaire');
        $tab_veto = $req_prep->fetchAll();
        // Attention, si il n'y a pas de r�sultats, on renvoie false
        if (empty($tab_veto))
            return false;
        return $tab_veto[0];
    }


}
