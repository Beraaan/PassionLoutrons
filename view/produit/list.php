<?php

echo '<h1>Liste des produits de la base : </h1>';
echo '<ul>';
foreach ($tab_p as $p)
    echo '<li><a href="http://localhost/PassionLoutrons/index.php?action=read&data=' . rawurlencode($p->getIdProduit()) . '">' . htmlspecialchars($p->getNom()) . '</a>.</li>';
echo '</ul>';
?>
