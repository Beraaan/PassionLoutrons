<?php

echo '<h2>Liste des commandes : </h2>';
echo '<ul>';
foreach ($tab_com as $c)
    echo '<li><a href="index.php?controller=commande&action=detailCommande&login='. rawurlencode($login).'&idCommande=' . rawurlencode($c->getIdCommande()) . '"> Commande du ' . htmlspecialchars($c->getDateCommande()) . '</a>.</li>';
echo '</ul>';

