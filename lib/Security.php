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

    public static function generateRandomHex() {
        // Generate a 32 digits hexadecimal number
        $numbytes = 16; // Because 32 digits hexadecimal = 16 bytes
        $bytes = openssl_random_pseudo_bytes($numbytes); 
        $hex   = bin2hex($bytes);
        return $hex;
     }


}