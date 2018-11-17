<?php
echo '<h2>' . strtoupper($u->getNom()). ' '  .$u->getPrenom(). ' - <i>' . $u->getLogin(). '</i></h2>' . 
        $u->getMail() . '<br>D\'où je viens : ' . $u->getVille() . '</li><br>';
