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
 
    public static function create() {
        $view = 'create';
        $pagetitle = 'Création d\'un produit !';
        require (File::build_path(array("view", "view.php")));  //redirige vers la vue
    }

    public static function created($nom, $prix, $nbdispo) {
        $view = 'created';
        $pagetitle = 'Création réussie !';
        $p = new ModelProduit($nom, $prix, $nbdispo);
        $p->save();
        require (File::build_path(array("view", "view.php")));
    }
    
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
                "idProduit" => myGet('pkey'),
                "nom" => myGet('nom'),
                "prix" => myGet('prix'),
                "nbDispo" => myGet('nbDispo')
            );
            ModelProduit::update($data);
            $tab_p = ModelProduit::selectAll();
            require File::build_path(array("view", "view.php"));
        }
        else {
            self::connect();
        }    
    }
    
    public static function delete($pkey, $pvalue) {
        if (Session::is_admin()) {
            Model::delete(self::$object, $pkey, $pvalue);
            $view = 'deleted';
            $pagetitle='Produit supprimé';
            require File::build_path(array("view", "view.php")); 
        }
        else {
            self::connect();
        }
    }
}
