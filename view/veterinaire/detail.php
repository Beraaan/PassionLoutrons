<?php
echo '<h2>' . strtoupper($v->getNom()). ' '  .$v->getPrenom(). ' - <i>' . $v->getLogin(). '</i></h2>' . 
        'Mon adresse : ' . $v->getAdresse() . ' à ' . $v->getVille() . '<br>Mon téléphone : ' . $v->getTelephone() . '<br>' . $v->getMail() .'</li><br>';
