<?php

echo "L'utilisateur " .$data['login']. " a bien été mis à jour !";
require File::build_path(array('view', 'utilisateur', 'list.php'));