<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="/PassionLoutrons/view/styles.css">
        <link rel="icon" type="image/png" href="/PassionLoutrons/view/img/loutre2.png" />
        
        <title><?php echo $pagetitle; ?></title>

    <!--<p style="border: 1px solid #ccccff;text-align:center;padding-right:1em;">-->   
    <ul id="menu">
        <li><a href="index.php"><img src="/PassionLoutrons/view/img/loutre2.png" height="12%" width="12%" alt="Loutre" /></a></li>
        <li><a href="index.php"><strong>Nos produiiiiits</strong></a></li>
        <li> <a href="index.php?controller=utilisateur"><strong>Les zutzuts</strong></a></li>
        <li> <a href="index.php?controller=veterinaire"><strong>Les vetoooos</strong></a></li>
        <li> <a href="index.php?controller=utilisateur&action=create"><strong>Veneeeezzz !</strong></a></li>
        <?php 
            if (isset($_SESSION['login'])) {
                echo '<li><strong>Bienvenue '.$_SESSION['login'].' !</strong></li>';
                echo '<li> <a href="index.php?controller=utilisateur&action=deconnect"><strong>Se déconnecter</strong></a></li>';
            }
            else {
                echo '<li> <a href="index.php?controller=utilisateur&action=connect"><strong>Se connecter !</strong></a></li>';
            }
        ?>
    </ul>

    <!--</p>-->

</head>
<body>
    <?php
    $filepath = File::build_path(array("view", static::$object, "$view.php"));
    require_once $filepath;
    ?>

</body>

<footer>
    <p style="border: 1px solid #ccccff;text-align:right;padding-right:1em;">
        Le meilleur site par Vincent & Bérangère
    </p>


</footer>
</html>

