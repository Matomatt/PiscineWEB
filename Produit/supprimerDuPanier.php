<?php

	$db_handle = mysqli_connect('localhost', 'root', '');
    $db_found = mysqli_select_db($db_handle, 'ecebay');

    if (!$db_found) { die('Database not found'); }
	
	/*$id=$_GET['idItem'];

	echo $id;*/

	$query = "DELETE FROM paniers WHERE idItem=".$_GET["idItem"]."";
	/*$id=$_GET['idItem']." ";*/


    $result = mysqli_query($db_handle, $query);

	// requête de suppression
	if($result)
	{
     	echo $id." a bien été supprimé";
     	echo '<a href="../Acheteur/panier.php">retour au panier</a>';
    }
	else
     	echo "Erreur lors de la suppression";

?>
