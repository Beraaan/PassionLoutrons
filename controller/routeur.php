<?php

//require_once '../lib/File.php';
require_once File::build_path(array("controller", "ControllerProduit.php")); 
require_once File::build_path(array("controller", "ControllerUtilisateur.php")); 
require_once File::build_path(array("controller", "ControllerVeterinaire.php")); 

if (isset($_GET['controller'])) $controller = $_GET['controller'];
else $controller = 'produit';

$controller_class = 'Controller' .ucfirst($controller);

//echo $controller . '<br>' . $controller_class . '<br><br>';

if (!class_exists($controller_class)) ControllerProduit::error();
else {
        if (isset($_GET['action'])) $action = $_GET['action'];
        else $action = 'readAll';

        if (!in_array($action, get_class_methods($controller_class))) {
            $action = 'error';
            $controller_class::$action();
        }

        else {
            if($action == "readAll") {
            $controller_class::$action(); // Appel de la méthode statique $action du Controller
        }

        if($action == "read") {
            $data = $_GET['data'];
            $controller_class::$action($data); // Appel de la méthode statique $action de ControllerVoiture
        }
//
//        if($action == "create") {
//            ControllerVoiture::$action(); // Appel de la méthode statique $action de ControllerVoiture
//        }
//
//        if($action == "created") {
//            $immat = $_GET['immat'];
//            $mar = $_GET['marque'];
//            $coul = $_GET['couleur'];
//            ControllerVoiture::$action($immat, $mar, $coul);
//        }
//
//        if($action == "delete") {
//            $immat = $_GET['immat'];
//            ControllerVoiture::$action($immat); // Appel de la méthode statique $action de ControllerVoiture
//        }
//
//        if($action == "update") {
//            $immat = $_GET['immat'];
//            ControllerVoiture::$action($immat); // Appel de la méthode statique $action de ControllerVoiture
//        }
//
//        if($action == "updated") {
//            ControllerVoiture::$action(); // Appel de la méthode statique $action de ControllerVoiture
//        }
//        
}
}


?>
