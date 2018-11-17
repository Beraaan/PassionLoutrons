<?php

//require_once '/../lib/File.php';
require_once File::build_path(array("model", "ModelVeterinaire.php")); // chargement du modèle

class ControllerVeterinaire {

    protected static $object = 'veterinaire';

    public static function readAll() {
        $view = 'list';
        $pagetitle = 'Plein d\'ut-uts';
        $tab_v = ModelVeterinaire::selectAll();     //appel au modèle pour gerer la BD
        require (File::build_path(array("view", "view.php")));  //redirige vers la vue
    }

    public static function read($primary) {
        $view = 'detail';
        $pagetitle = 'Ce véto !';
        $v = ModelVeterinaire::select($primary);
        if (empty($v))
            require (File::build_path(array("view", $object, "error.php")));
        else {
            require (File::build_path(array("view", "view.php")));
        }
    }

}
