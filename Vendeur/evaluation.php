<div id="div2">
	<br>
	<table>
	<tr>
		<th style="text-align: center">Article</th>
		<th style="text-align: center">Date</th>
		<th style="text-align: center">Commentaires</th>
		<th style="text-align: center">Note</th>
	</tr>
	
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
    
    if ($_SESSION["UserType"] != "Vendeur")
    {
        die('<script>
                alert("Veuillez vous connecter à votre compte Vendeur");
                window.location = "../CreerCompte/connexion.php";
            </script>');
    }

    $ID_Vendeur=(isset($_SESSION["UserID"])?$_SESSION["UserID"]:"");

    $query = "SELECT * FROM notes WHERE ID_Vendeur=".$ID_Vendeur." ORDER BY Date DESC";
    $result = mysqli_query($db_handle, $query);

    if (!$result)
    {
        die('Couldn\'t find table');
    }

    while($row = $result->fetch_assoc()) 
    {
        $query = "SELECT * FROM items WHERE ID=".$row["ID_Item"];
        $result2 = mysqli_query($db_handle, $query);
        
        if (!$result2)
        {
            die('Couldn\'t find table');
        }
        
        $item = $result2->fetch_assoc(); 
        $img = mysqli_query($db_handle, "SELECT File FROM medias WHERE ID_Item=" . $row["ID_Item"] . " AND indx = 0;");
        $img = ($img)?$img->fetch_assoc() ["File"]:"blank.png";
        ?>
		<tr>
			<td style="text-align: center">
				<figure>
					<img onclick="location.href='../Produit/index.php?id=<?php echo $row["ID_Item"]; ?>';" src="../UploadedContent/<?php echo $img;?>" style="max-width: 10em; max-height: 8em;">
					<figcaption><?php echo $item["Nom"]; ?></figcaption>
				</figure>
			</td>
			<td style="text-align: center"><?php echo $row["Date"]; ?></td>
			<td style="text-align: center"><?php echo $row["Commentaire"]; ?></td>
			<td style="text-align: center"><?php echo $row["Note"]/2; ?>/5 &#9733;</td>
		</tr>
		<?php } ?>
		
	</table>
</div>