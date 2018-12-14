<?php

require_once File::build_path(array("lib", "Session.php"));

   echo '<h2>' . strtoupper($u->getNom()). ' '  .$u->getPrenom(). ' - <i>' . $u->getLogin(). '</i></h2>' . 
        $u->getMail() . '<br>D\'où je viens : ' . $u->getVille() . '</li><br>';

   if (Session::is_user($u->getLogin()) || Session::is_admin()) {
        echo '<p><a href="index.php?controller=utilisateur&action=update&pkey=' . rawurldecode($u->getLogin()) . '">Modifier</a></p>';
        echo '<p><a href="index.php?controller=commande&action=historique&login=' . rawurldecode($u->getLogin()) . '">Historique des commandes</a></p>';
        echo '<p><a href="index.php?controller=utilisateur&action=delete&pkey=login&pvalue=' . rawurldecode($u->getLogin()) . '">Supprimer le compte</a></p>';
   }
?>