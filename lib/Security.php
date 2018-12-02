<?php

class Security {
    
    protected static $object = 'security';
    private static $seed = 'MR56T9Z1ZU';
      
    public static function chiffrer($texte_en_clair) {
        $texte_sale = $texte_en_clair . self::getSeed();
        $texte_chiffre = hash('sha256', $texte_sale);
        return $texte_chiffre;
    }
   
    public static function getSeed() {
        return self::$seed;
    }


}