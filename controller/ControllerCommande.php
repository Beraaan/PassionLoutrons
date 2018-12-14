<?php

require_once File::build_path(array("model", "ModelCommande.php")); // chargement du modèle
require_once File::build_path(array("model", "ModelProduit.php")); // chargement du modèle
require_once File::build_path(array("model", "ModelUtilisateur.php")); // chargement du modèle

class ControllerCommande {

    protected static $object = 'commande';
    
    public static function ajout($idProduit) {
        if (!ModelProduit::getProduitById($idProduit)) {
            echo 'Erreur ajout panier: mauvais id';
            ModelProduit::readAll();
        }
        else {
            $p = ModelProduit::getProduitById($idProduit);
            array_push($_SESSION['panier'], $idProduit);
            $_SESSION['prix'] += $p->getPrix();
            ControllerProduit::read($idProduit);
        }
    }
    
    public static function panier() {
        $view = 'panier';
        $pagetitle = 'Mon panier';
        require File::build_path(array("view", "view.php"));
    }
    
    public static function enlever($idProduit) {
        if (!ModelProduit::getProduitById($idProduit)) {
            echo 'Erreur retrait panier: mauvais id';
            ModelProduit::readAll();
        }
        else {
            $key = array_search($idProduit, $_SESSION['panier']);
            if($key!==false){
                $id = $_SESSION['panier'][$key];
                $p = ModelProduit::getProduitById($id);
                unset($_SESSION['panier'][$key]);
            }   
            $_SESSION['prix'] -= $p->getPrix();
            self::panier();
        }
    }
    
    public static function commander() {
        if (!isset($_SESSION['login'])) {
            echo 'Connectez vous avant de commander';
            ModelProduit::panier();
        }
        else {
            if (count($_SESSION['panier']) > 0) {
                $view = 'commander';
                $pagetitle = 'Commande passée !';
                ModelCommande::commander();
                require File::build_path(array("view", "view.php"));
            }
            else {
                echo 'Le panier est vide';
                self::panier();           
            }
        }
    }
    
    public static function historique($login) {
        if (Session::is_user($login) || Session::is_admin()) {
            $view = 'historique';
            $pagetitle = 'Historique des commandes';
            $tab_com = ModelCommande::getCommandeByLogin($login);
            require File::build_path(array("view", "view.php"));
        }
        else {
            ControllerUtilisateur::connect();            
        }        
    }
    
    public static function detailCommande($login, $idCommande) {
        if (Session::is_user($login) || Session::is_admin()) {
            $view = 'detailCommande';
            $pagetitle = 'Detail de la commande';
            $tab_detail = ModelCommande::getDetailCommandeById($idCommande);
            require File::build_path(array("view", "view.php"));
        }
        else {
             ControllerUtilisateur::connect();
        }      
    }
}