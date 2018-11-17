<?php
echo '<h1>Liste des vétérinaires de la base : </h1>';
echo '<ul>';
foreach ($tab_v as $v)
echo '<li>' . $v->getNom(). ' '  .$v->getPrenom(). ' - <i>' . $v->getLogin(). '</i><br><a href="http://localhost/PassionLoutrons/index.php?action=read&controller=veterinaire&data=' . rawurlencode($v->getLogin()) . '">Voir le profil</a>.</li><br>';
echo '</ul>';
?>
