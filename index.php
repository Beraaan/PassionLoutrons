<?php
session_start();

require_once __DIR__.DIRECTORY_SEPARATOR. "lib" .DIRECTORY_SEPARATOR. "File.php";

if (!isset($_SESSION['panier'])) {
    $_SESSION['panier']= array();
}

if (!isset($_SESSION['prix'])) {
    $_SESSION['prix'] = 0;
}

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > (30*60))) {
    // if last request was more than 30 minutes ago
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
    setcookie(session_name(),'',time()-1);
} 
else {
    $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
}




