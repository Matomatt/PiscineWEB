<div class="PublierItem " >
    <div class="col-lg-10 col-xs-5">
        <h3>Publier un produit</h3>
        <button class="btn btn-primary" onclick="window.location.href='../MiseEnVente/index.html'">Ajouter une fiche produit</button>
    </div>

</div>
<div class="AddSupprItem" >
    <div class="col-lg-10 col-xs-5">
        <h3>Gérer mes produit</h3>
        <button class="btn btn-primary" onclick="window.location.href='../Vendeur/boutique.php?id=<?php echo $_SESSION['UserID'];?>'">Modifier un produit</button><br>
        <button class="btn btn-primary" onclick="window.location.href='../Vendeur/boutique.php?id=<?php echo $_SESSION['UserID'];?>'">Supprimer un produit</button>
    </div>
</div>