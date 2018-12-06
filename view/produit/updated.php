<?php

echo "Le produit " .$data['nom']. " a bien été mis à jour !";
require File::build_path(array('view', 'produit', 'list.php'));