<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="./view/styles.css">
        <link rel="icon" type="image/png" href="./view/img/loutre2.png" />
        
        <title><?php echo $pagetitle; ?></title>
</head>

<body>
    <header>
        <!--<p style="border: 1px solid #ccccff;text-align:center;padding-right:1em;">-->   
        <div id="titre">
            <a href="index.php"><img id=loutre src="./view/img/loutre2.png" alt="Loutre" /></a>
            <h1>Passion Loutrons</h1>
        </div>
        <ul id="menu">
                <li><a href="index.php"><strong>Nos produiiiiits</strong></a></li>
                <li> <a href="index.php?controller=utilisateur"><strong>Les zutzuts</strong></a></li>
                <li> <a href="index.php?controller=utilisateur&action=create"><strong>Veneeeezzz !</strong></a></li>
                <li> <a href="index.php?controller=commande&action=panier"><strong>Panier: <?php if (isset($_SESSION['prix'])) echo $_SESSION['prix']; else echo '0'; ?> €</strong></a></li>
                <?php 
                    if (isset($_SESSION['login'])) {
                        echo '<li><a href="index.php?controller=utilisateur&action=read&data='.rawurlencode($_SESSION['login']).'"><strong>Bienvenue '.$_SESSION['login'].' !</strong></a></li>';
                        echo '<li> <a href="index.php?controller=utilisateur&action=deconnect"><strong>Se déconnecter</strong></a></li>';
                    }
                    else {
                        echo '<li> <a href="index.php?controller=utilisateur&action=connect"><strong>Se connecter !</strong></a></li>';
                    }
                ?>
        </ul>
    </header>
    
    <div class="content">
        <?php
        $filepath = File::build_path(array("view", static::$object, "$view.php"));
        require_once $filepath;
        ?>
    </div>
    
    <footer class = "footer">
        <p style="border: 1px solid #ccccff;text-align:right;padding-right:1em;">
            Le meilleur site par Vincent & Bérangère
        </p>
    </footer>
</body>


</html>

