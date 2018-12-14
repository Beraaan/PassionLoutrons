<?php
echo '<h2>' .$p->getNom(). '</h2>' . $p->getPrix(). '€<br>Il en reste '  .$p->getNbDispo(). '<br>';

echo '<p><a href="index.php?controller=commande&action=ajout&idProduit='.rawurldecode($p->getIdProduit()).'">Ajouter au panier</a></p>';

 if (Session::is_admin()) {
      echo '<p><a href="index.php?controller=produit&action=update&pkey=' . rawurldecode($p->getIdProduit()) . '">Modifier</a></p>';
      echo '<p><a href="index.php?controller=produit&action=delete&pkey=idProduit&pvalue=' . rawurldecode($p->getIdProduit()) . '">Supprimer le produit</a></p>';     
 }
 ?>