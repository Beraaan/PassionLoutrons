<?php

class Security {
    
    protected static $object = 'security';
    private static $seed = 'MR56T9Z1ZU';
    
    public static function login() {
        $view = 'login';
        $pagetitle = 'Connexion';
        require (File::build_path(array("view", "view.php")));  //redirige vers la vue
    }
    
    public static function logined($login, $password) {
        $view = 'logined';
        $pagetitle = 'Connecté !';
        require (File::build_path(array("view", "view.php")));
    }
    
    public static function chiffrer($texte_en_clair) {
        $texte_sale = $texte_en_clair . Security::getSeed();
        $texte_chiffre = hash('sha256', $texte_sale);
        return $texte_chiffre;
    }
   
    public static function getSeed() {
        return self::$seed;
    }


}