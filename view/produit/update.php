<!DOCTYPE! html>

 <form method="<?php if (Conf::getDebug()) echo 'get';
      else echo 'post'; ?>" action="index.php">
    <fieldset>
        <legend>Modifier un produit :</legend>
        <p>
            <input type='hidden' name='action' value='updated'>
            <input type='hidden' name='controller' value='produit'>
        </p>
        
        <p>
          <input type='text' value=<?php echo htmlspecialchars($p->getIdProduit())?> name="pkey" id="pkey" readonly/>
        </p>
        
         <p>
          <label for="nom">Nom</label> :
          <input type="text" value=<?php echo htmlspecialchars($p->getNom())?> name="nom" id="nom" required/>
        </p>
        
         <p>
          <label for="prix">Prix</label> :
          <input type="text" value=<?php echo htmlspecialchars($p->getPrix())?> name="prix" id="prix" required/>
        </p>
        
        <p>
          <label for="nbDispo">Nombre de produits disponibles :</label> :
          <input type="text" value=<?php echo htmlspecialchars($p->getNbDispo())?> name="nbDispo" id="nbDispo" required/>
        </p>
        
        <p>
          <input type="submit" value="Envoyer" />
        </p>
    </fieldset> 
            
 </form>
