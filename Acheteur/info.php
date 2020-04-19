<!DOCTYPE html>
<html>
    <head >
        <meta charset= "utf-8">
        <meta name= "viewport" content= "width=device-width, initial-scale=1">

        <!-- importing bootstrap-->
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

        <title>Informations Acheteur ECEbay</title>

    </head>

    <body>
    	<?php
	    include '../header.php';
	    ?>

    	<h6><a href="javascript:history.back()"><- Retour aux résultats</a></h6>

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
		
		if ($_SESSION["UserType"] != "Acheteur")
		{
			die('<script>
			        alert("Veuillez vous connecter à votre compte Acheteur");
			        window.location = "../CreerCompte/connexion.php";
			    </script>');
		}

		$id=(isset($_SESSION["UserID"])?$_SESSION["UserID"]:"");

		/*on récupère les données de la table acheteurs*/
		$query = "SELECT * FROM acheteurs WHERE ID_Adresse=".$id."";
		$result = mysqli_query($db_handle, $query);

		if (!$result)
		{
			die('Couldn\'t find table 1');
		}
				                        
		if (mysqli_num_rows($result) < 1)
		{
			die('Empty');
		}  

		while($row = $result->fetch_assoc()) 
		{
			$query = "SELECT * FROM adresses WHERE ID=".$row["ID_Adresse"]."";
			$result = mysqli_query($db_handle, $query);

			if (!$result)
			{
				die('Couldn\'t find table 2');
			}
				                        
			if (mysqli_num_rows($result) < 1)
			{
				die('Empty');
			} 

			$row2=0;
			$row2=$result->fetch_assoc();

			echo'	<table>
						<tr>
							<td>Nom : </td>
							<td>'.$row["Nom"].'</td>
						</tr>
						<tr>
							<td>Prénom : </td>
							<td>'.$row["Prenom"].'</td>
						</tr>
						<tr>
							<td>Adresse ligne 1 : </td>
							<td>'.$row2["Adresse_ligne_1"].'</td>
						</tr>
						<tr>
							<td>Adresse ligne 2 : </td>
							<td>'.$row2["Adresse_ligne_2"].'</td>
						</tr>
						<tr>
							<td>Ville : </td>
							<td>'.$row2["Ville"].'</td>
						</tr>
						<tr>
							<td>Code Postal : </td>
							<td>'.$row2["Code_postale"].'</td>
						</tr>
						<tr>
							<td>Pays : </td>
							<td>'.$row2["Pays"].'</td>
						</tr>
						<tr>
							<td>Numéro de téléphone : </td>
							<td>'.$row2["Telephone"].'</td>
						</tr>
						<tr>
							<td>Adresse mail : </td>
							<td>'.$row["Email"].'</td>
						</tr>		
					</table>';
		}
					        
	?>
	</body>
</html>