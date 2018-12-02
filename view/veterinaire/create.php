<!DOCTYPE html>
    
<form method="get" action="index.php">
    <fieldset>
        <legend>Je m'inscris :</legend>
        <p>
            <input type='hidden' name='action' value='created'>
            <input type='hidden' name='controller' value='veterinaire'>
        </p>
        
        <p>
          <label for="login">Mon sublime pseudo</label> :
          <input type="text" name="login" id="login" required/>
        </p>
        
        <p>
          <label for="password">Mon mot de passe</label> :
          <input type="password" name="password" id="password" required/>
        </p>
        
        <p>
          <label for="nom">Mon nom</label> :
          <input type="text" name="nom" id="nom" required/>
        </p>
        
         <p>
          <label for="prenom">Mon prénom</label> :
          <input type="text" name="prenom" id="prenom" required/>
        </p>
        
         <p>
          <label for="adresse">Mon adresse</label> :
          <input type="text" name="adresse" id="adresse" required/>
        </p>
        
        <p>
          <label for="ville">Dans quel état j'erre ?</label> :
          <input type="text" placeholder="La ville suffit" name="ville" id="ville" required/>
        </p>
        
        <p>
          <label for="mail">Mon mail</label> :
          <input type="email" name="mail" id="mail" required/>
        </p>
        
        <p>
          <label for="tel">Mon n° de téléphone</label> :
          <input type="tel" name="tel" id="tel" required/>
        </p>
        
        
        <p>
          <input type="submit" value="Envoyer" />
        </p>
    </fieldset> 
            
 </form>