<?php

echo '<h2>Détail de la commande : </h2>';
echo '<ul>';
foreach ($tab_detail as $c) {
    $p = ModelProduit::getProduitById($c[1]);
    echo '<p>'.$p->getNom().' - Quantité: '.$c[2].'</p>';
}
echo '</ul>';

