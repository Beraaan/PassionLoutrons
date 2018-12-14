<?php
echo '<h2>Liste des utilisateurs de la base : </h2>';
echo '<ul>';
foreach ($tab_u as $u)
echo '<li>' . $u->getNom(). ' '  .$u->getPrenom(). ' - <i>' . $u->getLogin(). '</i><br><a href="index.php?action=read&controller=utilisateur&data=' . rawurlencode($u->getLogin()) . '">Voir le profil</a>.</li><br>';
echo '</ul>';
?>
