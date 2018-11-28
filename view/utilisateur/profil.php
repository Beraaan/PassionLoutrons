<?php
   echo '<h2>' . strtoupper($u->getNom()). ' '  .$u->getPrenom(). ' - <i>' . $u->getLogin(). '</i></h2>' . 
        $u->getMail() . '<br>D\'où je viens : ' . $u->getVille() . '</li><br>';
//    echo '<p><a href="http://localhost/TD6/index.php?action=delete&immat=' . rawurldecode($immat) . '">Poubelle</a></p>';
   
    echo '<p><a href="http://localhost/PassionLoutrons/index.php?action=update&login=' . rawurldecode($u->getLogin()) . '">Modifier</a></p>';
?>