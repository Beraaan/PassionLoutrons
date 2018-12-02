<!DOCTYPE! html>

 <form method="get" action="index.php">
    <fieldset>
        <legend>Modifier un vétérinaire :</legend>
        <p>
            <input type='hidden' name='action' value='updated'>
        </p>
        
        <p>
          <label for="login">Login</label> :
          <input type="text" value=<?php echo htmlspecialchars($v->getLogin())?> name="login" id="login" readonly/>
        </p>
        
         <p>
          <label for="nom">Nom</label> :
          <input type="text" value=<?php echo htmlspecialchars($v->getNom())?> name="nom" id="nom" required/>
        </p>
        
         <p>
          <label for="prenom">Prenom</label> :
          <input type="text" value=<?php echo htmlspecialchars($v->getPrenom())?> name="prenom" id="prenom" required/>
        </p>
        
        <p>
          <label for="ville">Ville</label> :
          <input type="text" value=<?php echo htmlspecialchars($v->getVille())?> name="ville" id="ville" required/>
        </p>
        
        <p>
          <label for="adresse">Adresse</label> :
          <input type="text" value=<?php echo htmlspecialchars($v->getAdresse())?> name="adresse" id="adresse" required/>
        </p>
        
        <p>
          <label for="mail">Mail</label> :
          <input type="text" value=<?php echo htmlspecialchars($v->getMail())?> name="mail" id="mail" required/>
        </p>
        
        <p>
          <label for="telephone">Telephone</label> :
          <input type="text" value=<?php echo htmlspecialchars($v->getTelephone())?> name="telephone" id="telephone" required/>
        </p>
        
        <p>
          <input type="submit" value="Envoyer" />
        </p>
    </fieldset> 
            
 </form>
