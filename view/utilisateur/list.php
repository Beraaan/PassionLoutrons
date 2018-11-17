<?php
echo '<h1>Liste des utilisateurs de la base : </h1>';
echo '<ul>';
foreach ($tab_u as $u)
echo '<li>' . $u->getNom(). ' '  .$u->getPrenom(). ' - <i>' . $u->getLogin(). '</i><br><a href="http://localhost/PassionLoutrons/index.php?action=read&controller=utilisateur&data=' . rawurlencode($u->getLogin()) . '">Voir le profil</a>.</li><br>';
echo '</ul>';
?>
