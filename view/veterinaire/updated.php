<?php

echo "Le vétérinaire " .$data['login']. " a bien été mis à jour !";
require File::build_path(array('view', 'veterinaire', 'list.php'));