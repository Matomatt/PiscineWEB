<?php
	include '../header.php';
?>

<!DOCTYPE html>
<html>
<head>
	<!--accents-->
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" >
	<!--reseting my viewport, for making my website responsive-->
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<!-- importing bootstrap-->
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	<!--external style sheet-->
	<!--<link href="styles.css" rel="stylesheet" type="text/css">-->

	<title>Vérification de la commande ECEbay</title>
</head>
<body>
	<div class="row">
		<div class="table-responsive col-md-4">
			<table>
				<tr>
					<th>Adresse de livraison <a href="../Acheteur/modifier.html">Modifier</a></th>
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

			        echo'	<tr>
			        			<td>'.$row["Prenom"].'&nbsp;'.$row["Nom"].'</td>
			        		<tr>
			        		<tr>
			        			<td>'.$row2["Adresse_ligne_1"].'&nbsp;'.$row2["Adresse_ligne_2"].'</td>
			        		</tr>
			        		<tr>
			        			<td>'.$row2["Ville"].','.$row2["Code_postale"].'</td>
			        		<tr>
			        		<tr>
			        			<td>'.$row2["Pays"].'</td>
			        		</tr>
			        		<tr>
			        			<td>'.$row2["Telephone"].'
			        		</tr>';

			    	}
				?>
			</table>
		</div>

		<div class="table-responsive col-md-4">
			<table>
				<tr>
					<th>Mode de paiement <a href="#">Modifier</a></th>
				</tr>
				<tr>
					<td>Numéro carte?</td> 
				</tr>
				<tr>
					<th>Adresse de facturation <a href="#">Modifier</a></th>
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

			        echo'	<tr>
			        			<td>'.$row["Prenom"].'&nbsp;'.$row["Nom"].'</td>
			        		</tr>
			        		<tr>
			        			<td>'.$row2["Adresse_ligne_1"].'&nbsp;'.$row2["Adresse_ligne_2"].'</td>
			        		</tr>
			        		<tr>
			        			<td>'.$row2["Ville"].','.$row2["Code_postale"].'</td>
			        		</tr>
			        		<tr>
			        			<td>'.$row2["Pays"].'</td>
			        		</tr>
			        		<tr>
			        			<td>'.$row2["Telephone"].'
			        		</tr>';

			    	}
				?>
			</table>
		</div>

		<div class="table-responsive col-md-4">
			<table>
				<tr>
					<th>Récapitulatif</th>
				</tr>
				<tr> 
					<?php
        
		                $db_handle = mysqli_connect('localhost', 'root', '');
		                $db_found = mysqli_select_db($db_handle, 'ecebay');

		                if (!$db_found) { die('Database not found'); }

		                /*Pour avoir l'utilisateur connecté*/
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
		            
		                /*Pour avoir id de l'acheteur*/
		                $id=(isset($_SESSION["UserID"])?$_SESSION["UserID"]:"");
		                $query = "SELECT * FROM items WHERE ID IN (SELECT Id_Item FROM paniers WHERE ID_Acheteur=".$id.")";
		                $result = mysqli_query($db_handle, $query);

		                if (!$result)
		                {
		                    die('Couldn\'t find table');
		                }

		                $prixTotalArticle=0;

		                $prixTotalArticles=0;

		                while($row = $result->fetch_assoc()) 
		                {   
		                	$prixTotalArticle=$row["Prix"]*$row["Quantite"];
		           
		                    $prixTotalArticles=$prixTotalArticles+$prixTotalArticle;  
		                }

		                echo'<td>Articles : '.$prixTotalArticles.'€</td>
		                    </tr>';

		                echo '<tr>
		                    	<td>Livraison :'.$row["Frais_de_port"].'€</td>
		                    </tr>
		                    <tr>
		                    	<td><hr styles="border: 1px solid lightgrey;"></td>
		                    </tr>';

		                $prixTotal=0;
		                    
						$prixTotal=$prixTotalArticles+$row["Frais_de_port"];

		                echo '<tr>
		                        <td>Montant total : '.$prixTotal.'€</td>
		                    </tr>';    
		            ?>
		        <tr>
		            <td><button onclick="location.href='../Acheteur/compteclient.php';">Acheter</button></td>
		        </tr>
			</table>
		</div>
	</div>
	<br>
	<br>
	<div class="table-responsive">
		<table style="border: 1px solid black;
  border-collapse: collapse;">
			<?php
		        
		        $db_handle = mysqli_connect('localhost', 'root', '');
		        $db_found = mysqli_select_db($db_handle, 'ecebay');

		        if (!$db_found) { die('Database not found'); }

		        /*Pour avoir l'utilisateur connecté*/
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

		        /*Pour avoir id de l'acheteur*/
		        $id=(isset($_SESSION["UserID"])?$_SESSION["UserID"]:"");
		        $query = "SELECT * FROM items WHERE ID IN (SELECT Id_Item FROM paniers WHERE ID_Acheteur=".$id.")";
		        $result = mysqli_query($db_handle, $query);

		       	if (!$result)
		        {
		            die('Couldn\'t find table');
		        }

		        $prixTotalArticle=0;

		        $prixTotalArticles=0;

		        while($row = $result->fetch_assoc()) 
		        {   
		            /*on récupère les données de la table medias*/
		            $img = mysqli_query($db_handle, "SELECT File FROM medias WHERE ID_Item=" . $row["ID"] . " AND indx = 0;")->fetch_assoc() ["File"];
		            echo '<tr style="border: 1px solid black;
  border-collapse: collapse;">
		                    <td><img style="width:100px;" src="../UploadedContent/'. (($img!="") ? $img : 'blank.png') . '" ></td>';

		            echo '<td style="border: 1px solid black;
  border-collapse: collapse;">
		                    <p class="nomproduit"><strong>Nom produit : </strong>'.$row["Nom"].'</p>
		                    <p class="description">Description Produit : '.$row["Description"].'</p>
		                    </td>
		                    <td><p class="prix">Prix Unitaire : '.$row["Prix"].'€</p></td>
		                    <td><p class="quantite">Quantité : '.$row["Quantite"].'</p></td>
		                    <td><p class="prix">Prix : '.($prixTotalArticle=$row["Prix"]*$row["Quantite"]).'€</p></td>
		                    <td>Frais de port : '.$row["Frais_de_port"].'€</td>      
		             		<td>Prix Total : '.($prixTotalArticle+$row["Frais_de_port"]).'€</td>
		          	</tr>';   
		        }
		    ?>
		</table>
	</div>
</body>
</html>