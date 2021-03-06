<?php

require_once './lib/File.php';
require_once File::build_path(array("config", "Conf.php"));

class Model {

    public static $pdo;

    public static function Init() {
        $hst = Conf::getHostname();
        $dbn = Conf::getDatabase();
        $log = Conf::getLogin();
        $pass = Conf::getPassword();

        try {
            self::$pdo = new PDO("mysql:host=$hst;
            dbname=$dbn", $log, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage();
            } else {
                echo 'Une erreur est survenue <a href=""> retour à la page d\'accueil</a>';
            }
            die();
        }
    }
    
    public static function selectAll() {
         $table_name = static::$object;
         $class_name = 'Model'.ucfirst(static::$object);
//         echo $table_name . '<br>' .$class_name;
        $pdo = self::$pdo;
        $rep = $pdo->query("SELECT * FROM " .$table_name);
        $rep->setFetchMode(PDO::FETCH_CLASS, $class_name);
        $tab_obj = $rep->fetchAll();

        return $tab_obj;        
    }
    
       public static function select($primary_value) {
         $table_name = static::$object;
         $class_name = 'Model'.ucfirst(static::$object);
         $primary_key = static::$primary;
        
        $sql = "SELECT * FROM $table_name WHERE $primary_key=:nom_tag";
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
            "nom_tag" => $primary_value,
        );
        // On donne les valeurs et on exécute la requête	 
        $req_prep->execute($values);

        // On récupère les résultats comme précédemment
        $req_prep->setFetchMode(PDO::FETCH_CLASS, $class_name);
        $tab_res = $req_prep->fetchAll();
        // Attention, si il n'y a pas de resultats, on renvoie false
        if (empty($tab_res))
            {echo $table_name. 'non trouvé';
            return false;}
        return $tab_res[0];
    }
    
    public static function delete($table, $pkey, $pvalue) {
        $sql = "DELETE FROM $table WHERE $pkey=:tag_value";
        try {       
        // Préparation de la requête
        $req_prep = Model::$pdo->prepare($sql);
        } catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
        $values = array(
            "tag_value" => $pvalue
        );
        $req_prep->execute($values);
    }
    
//    public static function update ($data) {
//        $table_name = static::$object;
//        $primary_key = static::$primary;
//        
//        $sql = "UPDATE $table_name SET ";
//        foreach ($data as $tuple => $valeur) {
//            $sql = $sql."$tuple = $valeur";
//        }
//        $sql = $sql." WHERE $primary_key = :tag_pkey";
//        
//        try {
//            $req_prep = Model::$pdo->prepare($sql);
//        } catch (PDOException $e) {
//            if (Conf::getDebug()) {
//                echo $e->getMessage(); // affiche un message d'erreur
//            } else {
//                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
//            }
//            die();
//        }
//        $values = array(
//            "tag_pkey" => $data[$primary_key]
//        );
//        $req_prep->execute($values);
//    }
}

Model::Init();
