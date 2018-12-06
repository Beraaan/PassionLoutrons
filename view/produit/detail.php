<?php
echo '<h2>' .$p->getNom(). '</h2>' . $p->getPrix(). '€<br>Il en reste '  .$p->getNbDispo(). '<br>';

 if (Session::is_admin()) {
        echo '<p><a href="http://localhost/PassionLoutrons/index.php?controller=produit&action=update&pkey=' . rawurldecode($p->getIdProduit()) . '">Modifier</a></p>';
 }
 ?>