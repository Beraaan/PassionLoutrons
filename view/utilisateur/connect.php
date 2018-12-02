<!DOCTYPE html>
    
<form method="get" action="index.php">
    <fieldset>
        <legend>Je me connecte :</legend>
        <p>
            <input type='hidden' name='action' value='connected'>
            <input type='hidden' name='controller' value='utilisateur'>
        </p>
        
        <p>
          <label for="login">Mon super pseudo</label> :
          <input type="text" name="login" id="login" required/>
        </p>
        
        <p>
          <label for="password">Mon mot de passe</label> :
          <input type="password" name="password" id="password" required/>
        </p>
        
        <p>
          <input type="submit" value="Envoyer" />
        </p>
    </fieldset> 
            
 </form>

