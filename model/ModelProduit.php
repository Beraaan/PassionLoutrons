<?php

require_once (File::build_path(array("lib", "File.php")));
require_once File::build_path(array("model", "Model.php"));

class ModelProduit extends Model {

    private $idProduit;
    private $nom;
    private $prix;
    private $nbDispo;
    protected static $object = 'produit';
    protected static $primary = 'idProduit';

    // Constructeur
    public function __construct($idProduit = NULL, $nomProduit = NULL, $prix = NULL, $nbDispo = NULL) {
        if (!is_null($idProduit) && !is_null($nom) && !is_null($prix) && !is_null($nbDispo)) {
            $this->idProduit = $idProduit;
            $this->nomProduit = $nomProduit;
            $this->prix = $prix;
            $this->nbDispo = $nbDispo;
        }
    }

    // Getters
    public function getIdProduit() {
        return $this->idProduit;
    }

    public function getNom() {
        return $this->nomProduit;
    }

    public function getPrix() {
        return $this->prix;
    }

    public function getNbDispo() {
        return $this->nbDispo;
    }

    // Setters
    public function setIdProduit($idProd) {
        $this->idProduit = $idProd;
    }

    public function setNom($nouveauNom) {
        $this->nom = $nouveauNom;
    }

    public function setPrenom($nouveauPrix) {
        $this->prix = $nouveauPrix;
    }

    public function setVille($nouvelleDispo) {
        $this->nbDispo = $nouvelleDispo;
    }

}
