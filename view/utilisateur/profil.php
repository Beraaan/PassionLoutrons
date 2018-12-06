<?php

require_once File::build_path(array("lib", "Session.php"));

   echo '<h2>' . strtoupper($u->getNom()). ' '  .$u->getPrenom(). ' - <i>' . $u->getLogin(). '</i></h2>' . 
        $u->getMail() . '<br>D\'où je viens : ' . $u->getVille() . '</li><br>';

   if (Session::is_user($u->getLogin()) || Session::is_admin()) {
        echo '<p><a href="http://localhost/PassionLoutrons/index.php?controller=utilisateur&action=update&pkey=' . rawurldecode($u->getLogin()) . '">Modifier</a></p>';
        echo '<p><a href="http://localhost/PassionLoutrons/index.php?controller=utilisateur&action=delete&login=' . rawurldecode($u->getLogin()) . '">Supprimer le compte</a></p>';
   }
?>