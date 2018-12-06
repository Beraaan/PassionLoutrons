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
    
    public static function getProduitById($id) {
        $sql = "SELECT * FROM produit WHERE `idProduit`=:id_tag";
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
            "id_tag" => $id,
        );
        	 
        $req_prep->execute($values);

        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelProduit');
        $tab_prod = $req_prep->fetchAll();
   
        if (empty($tab_prod))
            return false;
        return $tab_prod[0];
    }
    
    public static function update($data) {
        $sql = "UPDATE `produit` SET `nomProduit`=:nom_tag, `prix`=:prix_tag, `nbDispo`=:nbDispo_tag WHERE `idProduit`=:id_tag";

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
            "id_tag" => $data['idProduit'],
            "nom_tag" => $data['nom'],
            "prix_tag" => $data['prix'],
            "nbDispo_tag" => $data['nbDispo']
        );

        $req_prep->execute($values);
    }

}
