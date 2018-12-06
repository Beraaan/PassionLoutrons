<?php

//require_once '/../lib/File.php';
require_once File::build_path(array("model", "ModelProduit.php")); // chargement du modèle

class ControllerProduit {

    protected static $object = 'produit';

    public static function readAll() {
        $view = 'list';
        $pagetitle = 'Plein de produuuiiiiiits';
        $tab_p = ModelProduit::selectAll();     //appel au modèle pour gerer la BD
        require (File::build_path(array("view", "view.php")));  //redirige vers la vue
    }
    
    public static function read($primary) {
        $view = 'detail';
        $pagetitle = 'Ce produit !';
        $p= ModelProduit::select($primary);
        if(empty($p)) require (File::build_path(array("view", $object, "error.php")));
        else { require (File::build_path(array("view", "view.php"))); }
    }
    
    public static function error() {
        $view = 'error';
        $pagetitle = 'Flute !';
        require(File::build_path(array('view', 'view.php')));
    }
    
    // EN COURS
     public static function update($id) {
        if (Session::is_admin()) {
            $view = 'update';
            $pagetitle = 'Modifier ce produit !';
            $p = ModelProduit::getProduitById($id);
             require (File::build_path(array("view", "view.php"))); 
        }
        else {
            self::connect();
        }    
    }
    
    public static function updated() {
        if (Session::is_admin()) {
            $view = 'updated';
            $pagetitle = 'Produit mis à jour !';
            $data = array(
                "idProduit" => $_GET['pkey'],
                "nom" => $_GET['nom'],
                "prix" => $_GET['prix'],
                "nbDispo" => $_GET['nbDispo']
            );
            ModelProduit::update($data);
            //$tab_u = ModelProduit::selectAll();
            require File::build_path(array("view", "view.php"));
        }
        else {
            self::connect();
        }    
    }
    
    
}
