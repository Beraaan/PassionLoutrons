<?php
    require_once File::build_path(array("lib", "Session.php"));
?>
<!DOCTYPE! html>

 <form method="<?php if (Conf::getDebug()) echo 'get';
      else echo 'post'; ?>" action="index.php">
    <fieldset>
        <legend>Modifier un utilisateur :</legend>
        <p>
            <input type='hidden' name='action' value='updated'>
            <input type='hidden' name='controller' value='utilisateur'>
        </p>
        
        <p>
          <label for="pkey">Login</label> :
          <input type="text" value=<?php echo htmlspecialchars($u->getLogin())?> name="pkey" id="pkey" readonly/>
        </p>
        
         <p>
          <label for="nom">Nom</label> :
          <input type="text" value=<?php echo htmlspecialchars($u->getNom())?> name="nom" id="nom" required/>
        </p>
        
         <p>
          <label for="prenom">Prenom</label> :
          <input type="text" value=<?php echo htmlspecialchars($u->getPrenom())?> name="prenom" id="prenom" required/>
        </p>
        
        <p>
          <label for="ville">Ville</label> :
          <input type="text" value=<?php echo htmlspecialchars($u->getVille())?> name="ville" id="ville" required/>
        </p>
        
        <p>
          <label for="adresse">Adresse</label> :
          <input type="text" value=<?php echo htmlspecialchars($u->getAdresse())?> name="adresse" id="adresse" required/>
        </p>
        
        <p>
          <label for="mail">Mail</label> :
          <input type="text" value=<?php echo htmlspecialchars($u->getMail())?> name="mail" id="mail" required/>
        </p>
        
        <?php 
            if (Session::is_admin()) {
                echo '<p>
                  <label for="admin">Administrateur ?</label>
                  <input type="checkbox" value="estAdmin" name="admin" id="admin"'; 
                if (ModelUtilisateur::checkAdmin($u->getLogin())) {
                    echo 'checked';
                }
                echo '/></p>';
            }
        ?>
        
        <p>
          <input type="submit" value="Envoyer" />
        </p>
    </fieldset> 
            
 </form>
