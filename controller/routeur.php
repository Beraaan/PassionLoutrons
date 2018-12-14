<?php

//require_once '../lib/File.php';
require_once File::build_path(array("controller", "ControllerProduit.php"));
require_once File::build_path(array("controller", "ControllerUtilisateur.php"));
require_once File::build_path(array("controller", "ControllerCommande.php"));
require_once File::build_path(array("lib", "Security.php"));

function myGet ($nomvar) {
    if (isset($_GET[$nomvar])) {
        return $_GET[$nomvar];
    }
    if (isset($_POST[$nomvar])) {
        return $_POST[$nomvar];
    }
    return NULL;
}

if (!is_null(myGet('controller')))
    $controller = myGet('controller');
else
    $controller = 'produit';

$controller_class = 'Controller' . ucfirst($controller);

//echo $controller . '<br>' . $controller_class . '<br><br>';

if (!class_exists($controller_class))
    ControllerProduit::error();
else {
    if (!is_null(myGet('action')))
        $action = myGet('action');
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
            $data = myGet('data');
            $controller_class::$action($data); // Appel de la méthode statique $action du Controller
        }

        if ($action == "create") {
            $controller_class::$action(); // Appel de la méthode statique $action du controller
        }

        if ($action == "created") {
            
            if ($controller == "utilisateur") {
                $login = myGet('login');
                $password = myGet('password');
                $nom = myGet('nom');
                $prenom = myGet('prenom');
                $adresse = myGet('adresse');
                $ville = myGet('ville');
                $mail = myGet('mail');
                $controller_class::$action($login, $password, $nom, $prenom, $ville, $adresse, $mail);
            } 
            
            else if ($controller == "veterinaire") {
                $login = myGet('login');
                $nom = myGet('nom');
                $prenom = myGet('prenom');
                $adresse = myGet('adresse');
                $ville = myGet('ville');
                $mail = myGet('mail');
                $tel = myGet('tel');
                $controller_class::$action($login, $nom, $prenom, $adresse, $ville, $mail, $tel);
            }
            
            else if ($controller == "produit") {
                $nom = myGet('nom');
                $prix = myGet('prix');
                $nbdispo = myGet('nbdispo');
                $controller_class::$action($nom, $prix, $nbdispo);
            }
        }
        
        if($action == "update") {
            $pkey = myGet('pkey');
            $controller_class::$action($pkey); // Appel de la méthode statique $action 
        }

        if($action == "updated") {
            $controller_class::$action(); // Appel de la méthode statique $action 
        }
        
        if($action == "delete") {
            $pvalue = myGet('pvalue');
            $pkey = myGet('pkey');
            $controller_class::$action($pkey, $pvalue); // Appel de la méthode statique $action 
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
        if ($action == 'validate') {
            $controller_class::$action();
        }
        if ($action == 'ajout' || $action == 'enlever') {
            $pkey = myGet('idProduit');
            $controller_class::$action($pkey);
        }
        if ($action == 'panier') {
            $controller_class::$action();
        }       
        if ($action == 'commander') {
            $controller_class::$action();
        }
        if ($action == 'historique') {
            $pkey = myGet('login');
            $controller_class::$action($pkey);
        }
        if ($action == 'detailCommande') {
            $pkey = myGet('login');
            $id = myGet('idCommande');
            $controller_class::$action($pkey, $id);
        }
    }
}

?>
