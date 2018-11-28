<?php
   echo '<h2>' . strtoupper($v->getNom()). ' '  .$v->getPrenom(). ' - <i>' . $v->getLogin(). '</i></h2>' . 
        $v->getMail() . '<br>D\'où je viens : ' . $v->getVille() . '</li><br>'. $v->getTelephone() . '</li><br>';
//    echo '<p><a href="http://localhost/TD6/index.php?action=delete&immat=' . rawurldecode($immat) . '">Poubelle</a></p>';
   
    echo '<p><a href="http://localhost/PassionLoutrons/index.php?action=update&login=' . rawurldecode($v->getLogin()) . '">Modifier</a></p>';
?>