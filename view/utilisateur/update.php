<!DOCTYPE! html>

 <form method="get" action="index.php">
    <fieldset>
        <legend>Modifier un utilisateur :</legend>
        <p>
            <input type='hidden' name='action' value='updated'>
        </p>
        
        <p>
          <label for="imm">Login</label> :
          <input type="text" value=<?php echo htmlspecialchars($v->getLogin())?> name="login" id="login" readonly/>
        </p>
        
         <p>
          <label for="marque">Nom</label> :
          <input type="text" value=<?php echo htmlspecialchars($v->getNom())?> name="nom" id="nom" required/>
        </p>
        
         <p>
          <label for="couleur">Prenom</label> :
          <input type="text" value=<?php echo htmlspecialchars($v->getPrenom())?> name="prenom" id="prenom" required/>
        </p>
        
        <p>
          <label for="couleur">Ville</label> :
          <input type="text" value=<?php echo htmlspecialchars($v->getVille())?> name="ville" id="ville" required/>
        </p>
        
        <p>
          <label for="couleur">Adresse</label> :
          <input type="text" value=<?php echo htmlspecialchars($v->getAdresse())?> name="adresse" id="adresse" required/>
        </p>
        
        <p>
          <label for="couleur">Mail</label> :
          <input type="text" value=<?php echo htmlspecialchars($v->getMail())?> name="mail" id="mail" required/>
        </p>
        
        <p>
          <input type="submit" value="Envoyer" />
        </p>
    </fieldset> 
            
 </form>
