<!DOCTYPE html>

<form method="
      <?php if (Conf::getDebug()) echo 'get';
      else echo 'post'; ?>
      " action="index.php">
    <fieldset>
        <legend>Ajout d'un produit</legend>
        <p>
            <input type='hidden' name='action' value='created'>
            <input type='hidden' name='controller' value='produit'>
        </p>
        
        <p>
          <label for="nom">Nom</label> :
          <input type="text" name="nom" id="nom" required/>
        </p>
        
        <p>
          <label for="prix">Prix</label> :
          <input type="text" name="prix" id="prix" required/>
        </p>
        
        <p>
          <label for="nbdispo">Nombre dispo</label> :
          <input type="text" name="nbdispo" id="nbdispo" required/>
        </p>
        
        <p>
          <input type="submit" value="Envoyer" />
        </p>
    </fieldset> 
            
 </form>
