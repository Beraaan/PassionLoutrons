<?php

echo '<h2>Liste des produits de la base : </h2>';
echo '<ul>';
foreach ($tab_p as $p)
    echo '<li><a href="index.php?action=read&data=' . rawurlencode($p->getIdProduit()) . '">' . htmlspecialchars($p->getNom()) . '</a>.</li>';
echo '</ul>';

if (Session::is_admin()) {
    echo '<p><a href = "index.php?controller=produit&action=create">Ajouter un produit</a></p>';
}
?>
