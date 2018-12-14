<?php
echo '<h2>Votre panier</h2>';
echo '<ul>';
if (isset($_SESSION['panier'])) {
    foreach ($_SESSION['panier'] as $a) {
        $p = ModelProduit::getProduitById($a);
        echo '<li>'.htmlspecialchars($p->getNom()).'<a href="index.php?controller=produit&action=enlever&idProduit='.rawurlencode($a).'">   Enlever</a></li>';
    }
}
echo '</ul>';

echo '<p><a href="index.php?controller=commande&action=commander">Valider ma commande</a></p>';
?>