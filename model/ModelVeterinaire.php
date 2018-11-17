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
            $this->nomV = $nom;
            $this->prenomV = $prenom;
            $this->ville = $ville;
            $this->telephone= $telephone;
            $this->adresse = $adresse;
            $this->mailV = $mailV;
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

}
