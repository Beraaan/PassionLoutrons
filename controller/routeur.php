<?php

//require_once '../lib/File.php';
require_once File::build_path(array("controller", "ControllerProduit.php"));
require_once File::build_path(array("controller", "ControllerUtilisateur.php"));
require_once File::build_path(array("controller", "ControllerVeterinaire.php"));
require_once File::build_path(array("lib", "Security.php"));

if (isset($_GET['controller']))
    $controller = $_GET['controller'];
else
    $controller = 'produit';

$controller_class = 'Controller' . ucfirst($controller);

//echo $controller . '<br>' . $controller_class . '<br><br>';

if (!class_exists($controller_class))
    ControllerProduit::error();
else {
    if (isset($_GET['action']))
        $action = $_GET['action'];
    else
        $action = 'readAll';

    if (!in_array($action, get_class_methods($controller_class))) {
        $action = 'error';
        $controller_class::$action();
    } else {
        if ($action == "readAll") {
            $controller_class::$action(); // Appel de la méthode statique $action du Controller
        }

        if ($action == "read") {
            $data = $_GET['data'];
            $controller_class::$action($data); // Appel de la méthode statique $action du Controller
        }

        if ($action == "create") {
            $controller_class::$action(); // Appel de la méthode statique $action du controller
        }

        if ($action == "created") {
            
            if ($controller == "utilisateur") {
                $login = $_GET['login'];
                $password = $_GET['password'];
                $nom = $_GET['nom'];
                $prenom = $_GET['prenom'];
                $adresse = $_GET['adresse'];
                $ville = $_GET['ville'];
                $mail = $_GET['mail'];
                $controller_class::$action($login, $password, $nom, $prenom, $ville, $adresse, $mail);
            } 
            
            else if ($controller == "veterinaire") {
                $login = $_GET['login'];
                $nom = $_GET['nom'];
                $prenom = $_GET['prenom'];
                $adresse = $_GET['adresse'];
                $ville = $_GET['ville'];
                $mail = $_GET['mail'];
                $tel = $_GET['tel'];
                $controller_class::$action($login, $nom, $prenom, $adresse, $ville, $mail, $tel);
            }
        }
        
        if($action == "update") {
            $login = $_GET['login'];
            $controller_class::$action($login); // Appel de la méthode statique $action 
        }

        if($action == "updated") {
            $controller_class::$action(); // Appel de la méthode statique $action 
        }
        
        if ($action == 'connect') {
            $controller_class::$action();
        }
        
        if ($action == 'connected') {
            $controller_class::$action();
        }
        
        if ($action == 'deconnect') {
            $controller_class::$action();
        }
//
//        if($action == "delete") {
//            $immat = $_GET['immat'];
//            ControllerVoiture::$action($immat); // Appel de la méthode statique $action de ControllerVoiture
//        }
//        
    }
}
?>
