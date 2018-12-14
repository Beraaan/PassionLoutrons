<?php

require_once (File::build_path(array("lib", "File.php")));
require_once File::build_path(array("model", "Model.php"));

class ModelProduit extends Model {

    private $idProduit;
    private $nomProduit;
    private $prix;
    private $nbDispo;
    protected static $object = 'produit';
    protected static $primary = 'idProduit';

    // Constructeur
    public function __construct($nomProduit = NULL, $prix = NULL, $nbDispo = NULL) {
        if (!is_null($nomProduit) && !is_null($prix) && !is_null($nbDispo)) {
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
    
    public function save() {
        $sql = "INSERT INTO produit (`idProduit`, `nomProduit`, `prix`, `nbDispo`)
                VALUES (NULL, :nomproduit, :prix, :nbdispo)";

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
            "nomproduit" => $this->nomProduit,
            "prix" => $this->prix,
            "nbdispo" => $this->nbDispo);
        
        $rep_prep->execute($values);
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
    
    

    
//    public static function delete($idProduit) {
//        $sql = "DELETE FROM produit WHERE idProduit=:tag_id";
//        try {       
//        // Préparation de la requête
//        $req_prep = Model::$pdo->prepare($sql);
//        } catch (PDOException $e) {
//            if (Conf::getDebug()) {
//                echo $e->getMessage(); // affiche un message d'erreur
//            } else {
//                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
//            }
//            die();
//        }
//        $values = array(
//            "tag_id" => $idProduit
//        );
//        $req_prep->execute($values);
//    }

}
