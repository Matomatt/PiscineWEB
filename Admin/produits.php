 <?php
    $db_handle = mysqli_connect('localhost', 'root', '');
    $db_found = mysqli_select_db($db_handle, 'ecebay');

    if (!$db_found) { die('Database not found'); }

    if (!isset($_SESSION["UserID"]) || !isset($_SESSION["UserType"]))
    {
        die('<script>
                alert("Veuillez vous connecter à votre compte");
                window.location = "../CreerCompte/connexion.php";
            </script>');
    }
    
    if ($_SESSION["UserType"] != "Admin")
    {
        die('<script>
                window.location = "../CreerCompte/connexion.php";
            </script>');
    }

    $ID=(isset($_SESSION["UserID"])?$_SESSION["UserID"]:"");
?>

<div class="container-fluid" style="text-align: center">
	<a href="../MiseEnVente/index.html">Ajouter un article</a>
	<form method="post" action="../Admin/modifId.php">
	Avec l'ID <input type="number" min="1" value="<?php echo $ID; ?>" name="id" style="max-width: 3em">
	<button class="btn btn-light" type="submit" style="font-size: 50%">Modifier</button>
	</form>
	<hr>
    <table border="1" frame="void" rules="all">
   <?php
    
        $query = "SELECT * FROM items ORDER BY ID DESC";
        $result = mysqli_query($db_handle, $query);
    
        if (!$result)
        {
            die('Couldn\'t find table');
        }
    
        while($item = $result->fetch_assoc()) 
        { 
            $boutique = mysqli_query($db_handle, 'SELECT Boutique FROM vendeurs WHERE ID="' . $item["ID_Vendeur"] . '";');
            $boutique = ($boutique?$boutique->fetch_assoc()["Boutique"]:"");
        ?>
            <tr>
            	<td><?php echo $item["Nom"]; ?></td>
            	<td><?php echo $item["Prix"]; ?></td>
            	<td><?php echo $item["Categorie"]; ?></td>
            	<td><?php echo $item["Type_de_vente_1"]; ?></td>
            	<td><?php echo $item["Type_de_vente_2"]; ?></td>
            	<td><?php echo $item["Date_MEV"]; ?></td>
            	<td><?php echo $item["Quantite"]; ?></td>
            	<td><a href="../Vendeur/boutique.php?id=<?php echo $item["ID_Vendeur"] . '">' . $boutique; ?> </a></td>
            	<td><a href="../Admin/deleteItem.php?id=<?php echo $item["ID"]; ?>">Supprimer</a></td>
            </tr>
       <?php } ?>
    
    </table>
</div>