<?php

require_once '/config/Conf.php';

echo 'Hostname : ' . Conf::getHostname() . '<br>Database : ' . Conf::getDatabase() . '<br>Login : ' . Conf::getLogin() . '<br>Password : ' . Conf::getPassword();
?>