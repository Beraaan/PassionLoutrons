<?php

require_once (File::build_path(array("lib", "File.php")));
require_once File::build_path(array("model", "Model.php"));

class ModelCommande extends Model {

    private $idCommande;
    private $loginClient;
    private $dateCommande;
    private $montant;
    protected static $object = 'commande';
    protected static $primary = 'idCommande';

    // Constructeur
    public function __construct($dateCommande = NULL, $montant = NULL, $loginClient = NULL) {
        if (!is_null($loginClient) && !is_null($dateCommande) && !is_null($montant)) {
            $this->loginClient = $loginClient;
            $this->dateCommande = $dateCommande;
            $this->montant = $montant;
        }
    }
    public function getIdCommande() {
        return $this->idCommande;
    }
    public function getLoginClient() {
        return $this->loginClient;
    }
    public function getDateCommande() {
        return $this->dateCommande;
    }
    public function getMontant() {
        return $this->montant;
    }
    
    public static function commander() {
        $sql = "INSERT INTO commande (`idCommande`, `loginClient`, `dateCommande`, `montant`)
                VALUES (:tag_com, :tag_login, :tag_date, :tag_montant)";
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
        
        $commande = $_SESSION['login'].time();
        
        $values = array(
            "tag_com" => $commande,
            "tag_login" => $_SESSION['login'],
            "tag_date" => date("Y-m-d"),
            "tag_montant" => $_SESSION['prix']
        );

        $req_prep->execute($values);
        
        $liste_article = array_count_values($_SESSION['panier']);
        
        foreach ($liste_article as $idproduit => $qte) {
            $sql = "INSERT INTO lignescommande (`idCommande`, `idProduit`, `quantite`)
                VALUES (:tag_com, :tag_prod, :tag_montant)";
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
                "tag_com" => $commande,
                "tag_prod" => $idproduit,
                "tag_montant" => $qte
            );

            $req_prep->execute($values);
            
            $_SESSION['panier'] = array();
            $_SESSION['prix'] = 0;
            
            $sql = "UPDATE produit SET nbDispo -= :tag_montant";
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
                "tag_montant" => $qte
            );
            
            $req_prep->execute($values);
        }
    }
    
    public static function getCommandeById($idCommande) {
        $sql = "SELECT * FROM commande WHERE `idCommande`=:id_tag";
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
            "id_tag" => $idCommande,
        );
        	 
        $req_prep->execute($values);
        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelCommande');
        $tab_prod = $req_prep->fetchAll();
   
        if (empty($tab_prod))
            return false;
        return $tab_prod[0];
    }
    
    public static function getCommandeByLogin($login) {
        $sql = "SELECT * FROM commande WHERE `loginClient`=:tag_login";
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
            "tag_login" => $login,
        );
        	 
        $req_prep->execute($values);
        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelCommande');
        $tab_com = $req_prep->fetchAll();
   
        if (empty($tab_com))
            return false;
        return $tab_com;
    }
    
    public static function getDetailCommandeById($idCommande) {
        $sql = "SELECT * FROM lignescommande WHERE `idCommande`=:id_tag";
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
            "id_tag" => $idCommande,
        );
        	 
        $req_prep->execute($values);
        $tab_prod = $req_prep->fetchAll();
   
        if (empty($tab_prod))
            return false;
        return $tab_prod;
    }
}
