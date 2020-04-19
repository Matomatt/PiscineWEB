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
	<form method="post" action="passercommande.php">
	<div class="row" >
		<div class="table-responsive col-md-4">
			<table>
				<tr>
					<th>Adresse de livraison <a href="../Acheteur/modifierDeb.php">Modifier</a></th>
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
			        $query = "SELECT * FROM acheteurs WHERE ID=".$id."";
			        $result = mysqli_query($db_handle, $query);

			        if (!$result)
			        {
			          die('Couldn\'t find table 1');
			        }
			                        
			        if (empty($result))
			        {
			          die('Empty');
			        }  

			        $Acheteur = $result->fetch_assoc();
			        
			        echo '<input type="number" name="ID_Adresse" value="'.$Acheteur["ID_Adresse"].'" style="display: none" \>';
			        
			        $query = "SELECT * FROM adresses WHERE ID=".$Acheteur["ID_Adresse"]."";
			        $result = mysqli_query($db_handle, $query);

			        if (!$result)
			        {
			          die('Couldn\'t find table 2');
			        }
			                        
			        if (mysqli_num_rows($result) < 1)
			        {
			          die('Empty');
			        }
			        
			        $adresse=$result->fetch_assoc();

			        echo'	<tr>
			        			<td>'.$Acheteur["Prenom"].'&nbsp;'.$Acheteur["Nom"].'</td>
			        		<tr>
			        		<tr>
			        			<td>'.$adresse["Adresse_ligne_1"].'&nbsp;'.$adresse["Adresse_ligne_2"].'</td>
			        		</tr>
			        		<tr>
			        			<td>'.$adresse["Ville"].', '.$adresse["Code_postale"].'</td>
			        		<tr>
			        		<tr>
			        			<td>'.$adresse["Pays"].'</td>
			        		</tr>
			        		<tr>
			        			<td>'.$adresse["Telephone"].'
			        		</tr>';
				?>
			</table>
		</div>

		<div class="table-responsive col-md-4">
			<table>
				<tr>
					<th>Mode de paiement</th>
				</tr>
				<tr><td>
									
    				<?php
                        $id=(isset($_SESSION["UserID"])?$_SESSION["UserID"]:"");
                    
                    
                        $sql = "SELECT * FROM carte_bancaires WHERE ID_Acheteur ='$id'";
                        $results = mysqli_query($db_handle, $sql);
                        
                        $good=1;
                        if (!$results)
                            $good=0;
                        if (mysqli_num_rows($result)==0 || $good==0)
                        {
                            die('<script>
        		                     alert("Veuillez ajouter un moyen de paiement");
        		                     window.location = "../Acheteur/mon_compte.php?page=infobancaires";
    		                     </script>');
                        }
                        else
                        {
                            echo '<select name="mdp">';
                            $first=0;
                            while($row = mysqli_fetch_array($results)) {
                                if ($first==0 && ($row["ID"] == "" || $row["ID"]==0))
                                    break;
                                echo '<option value="'.$row["ID"].'">XXXX-XXXX-XXXX-'.str_split($row['Numero'], 4)[3].'</option>';
                                $first = 1;
                            }
                            echo '</select>';
                            if ($first == 0)
                                die('<script>
        		                     alert("Veuillez ajouter un moyen de paiement");
        		                     window.location = "../Acheteur/mon_compte.php?page=infobancaires";
    		                     </script>');
                        }                        
                    ?>
                    
				</tr></td> 
				<tr>
					<th>Adresse de facturation <a href="../Acheteur/modifierDeb.php">Modifier</a></th>
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
			        $query = "SELECT * FROM acheteurs WHERE ID=".$id."";
			        $result = mysqli_query($db_handle, $query);
			        
			        if (!$result)
			        {
			            die('Couldn\'t find table 1');
			        }
			        
			        if (empty($result))
			        {
			            die('Empty');
			        }
			        
			        $Acheteur = $result->fetch_assoc();
			        $query = "SELECT * FROM adresses WHERE ID=".$Acheteur["ID_Adresse"]."";
			        $result = mysqli_query($db_handle, $query);
			        
			        if (!$result)
			        {
			            die('Couldn\'t find table 2');
			        }
			        
			        if (mysqli_num_rows($result) < 1)
			        {
			            die('Empty');
			        }
			        
			        $adresse=$result->fetch_assoc();
			        
			        echo'	<tr>
			        			<td>'.$Acheteur["Prenom"].'&nbsp;'.$Acheteur["Nom"].'</td>
			        		<tr>
			        		<tr>
			        			<td>'.$adresse["Adresse_ligne_1"].'&nbsp;'.$adresse["Adresse_ligne_2"].'</td>
			        		</tr>
			        		<tr>
			        			<td>'.$adresse["Ville"].', '.$adresse["Code_postale"].'</td>
			        		<tr>
			        		<tr>
			        			<td>'.$adresse["Pays"].'</td>
			        		</tr>
			        		<tr>
			        			<td>'.$adresse["Telephone"].'
			        		</tr>';
				?>
			</table>
		</div>

		<div class="table-responsive col-md-4" >
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
		                $ID_Acheteur=(isset($_SESSION["UserID"])?$_SESSION["UserID"]:"");
		                $query = "SELECT * FROM items WHERE ID IN (SELECT Id_Item FROM paniers WHERE ID_Acheteur=".$ID_Acheteur.")";
		                $result = mysqli_query($db_handle, $query);

		                if (!$result)
		                {
		                    die('Couldn\'t find table');
		                }

		                $prixTotalArticle=0;
		                $prixTotalArticles=0;
		                $totalfdp=0;

		                while($row = $result->fetch_assoc()) 
		                {   
		                    $PrixArticle = $row["Prix"];
		                    if ($row["Type_de_vente_1"] == "encheres")
		                        $PrixArticle = $row["Prix_Encheres"];
	                        else if ($row["Type_de_vente_1"] == "offres" || $row["Type_de_vente_2"] == "offres")
	                        {
	                            $offreAccepted = mysqli_query($db_handle,'SELECT Prix FROM offres WHERE ID_Item=' . $row["ID"] .' AND ID_Acheteur=' . $ID_Acheteur .' AND Accepted=1 ORDER BY Date DESC');
	                            
	                            if (!$offreAccepted)
	                                die ("Erreur lors de la requète");
	                                
	                                if (!empty($offreAccepted))
	                                {
	                                    $prixOffre = $offreAccepted->fetch_assoc()["Prix"];
	                                    $PrixArticle = ($prixOffre<$PrixArticle?$prixOffre:$PrixArticle);
	                                }
	                                
	                        }
	                        else if ($row["Type_de_vente_2"] == "encheres")
	                        {
	                            if (date('Y-m-d h:i:s', strtotime($row["Date_MEV"]. ' + 7 days')) < date('Y-m-d h:i:s', time()))
	                            {
	                                $MeilleureEnchere = mysqli_query($db_handle,'SELECT MAX(Prix_Max) as "PrixMax" FROM encheres WHERE ID_Item=' . $row["ID"] .' AND ID_Acheteur=' . $ID_Acheteur);
	                                
	                                if (!$MeilleureEnchere)
	                                    die ("Erreur lors de la requète");
	                                    
	                                    if (!empty($MeilleureEnchere))
	                                    {
	                                        $MeilleureEnchere = $MeilleureEnchere->fetch_assoc()["PrixMax"];
	                                        
	                                        if ($MeilleureEnchere["PrixMax"] >= $row["Prix_Encheres"])
	                                        {
	                                            $PrixArticle = $row["Prix_Encheres"];
	                                        }
	                                    }
	                            }
	                        }
	                        
	                        $queryQT = "SELECT Quantite FROM paniers WHERE Id_Item =" . $row["ID"] . " AND ID_Acheteur=".$ID_Acheteur.";";
	                        $resultQT = mysqli_query($db_handle, $queryQT);
	                        $Quantite = 1;
	                        if ($resultQT)
	                            $Quantite = $resultQT->fetch_assoc()["Quantite"];
		                        
                            $prixTotalArticle=$PrixArticle*$Quantite;
		           
		                    $prixTotalArticles=$prixTotalArticles+$prixTotalArticle;  
		                    
		                    $totalfdp+=($row["Frais_de_port"]>0)?$row["Frais_de_port"]:0;
		                }

		                echo'<td>Articles : '.$prixTotalArticles.'€</td>
		                    </tr>';

		                echo '<tr>
		                    	<td>Livraison :'.$totalfdp.'€</td>
		                    </tr>
		                    <tr>
		                    	<td><hr styles="border: 1px solid lightgrey;"></td>
		                    </tr>';
		                    
		                $prixTotal=$prixTotalArticles+$totalfdp;

		                echo '<tr>
		                        <td>Montant total : '.$prixTotal.'€</td>
		                    </tr>';    
		            ?>
		        <tr>
		            <td><button class="btn btn-danger" type="submit">Acheter</button></td>
		        </tr>
			</table>
		</div>
	</div>
	<br>
	<br>
	<div class="table-responsive">
		<table rules=rows style="border: 1px solid black; border-collapse: collapse;">
			<?php
                $db_handle = mysqli_connect('localhost', 'root', '');
                $db_found = mysqli_select_db($db_handle, 'ecebay');

                if (!$db_found) { die('Database not found'); }

                /*Pour avoir l'utilisateur connecté*/
                if (!isset($_SESSION['UserType']) || !isset($_SESSION['UserID']))
                    echo '<script> window.location = "../CreerCompte/connexion.php"; </script>';
                    
                if ($_SESSION['UserType'] != "Acheteur")
                    echo '<script> window.location = "../CreerCompte/connexion.php"; </script>';
                                        

                /*Pour avoir id de l'acheteur*/
                $ID_Acheteur=(isset($_SESSION["UserID"])?$_SESSION["UserID"]:"");
                $query = "SELECT * FROM items WHERE ID IN (SELECT Id_Item FROM paniers WHERE ID_Acheteur=".$ID_Acheteur.")";
                $result = mysqli_query($db_handle, $query);

                if (!$result)
                {
                  die('Couldn\'t find table');
                }

                $nbItem=0;
                while($row = $result->fetch_assoc()) 
                {   
                    $queryQT = "SELECT Quantite FROM paniers WHERE Id_Item =" . $row["ID"] . " AND ID_Acheteur=".$ID_Acheteur.";";
                    $resultQT = mysqli_query($db_handle, $queryQT);
                    $Quantite = 1;
                    if ($resultQT)
                    {
                        $Quantite = $resultQT->fetch_assoc()["Quantite"];
                    }
                    /*on récupère les données de la table medias*/
                    $img = mysqli_query($db_handle, "SELECT File FROM medias WHERE ID_Item=" . $row["ID"] . " AND indx = 0;")->fetch_assoc() ["File"];
                    echo '<tr>
                            <td style="text-align: center"><img style="max-width: 10em; max-height: 10em" src="../UploadedContent/'. (($img!="") ? $img : 'blank.png') . '" ></td>';

                    $type_de_vente = "achat_imm";
                    $PrixArticle = $row["Prix"];
                    if ($row["Type_de_vente_1"] == "encheres")
                    {
                        $PrixArticle = $row["Prix_Encheres"];
                        $type_de_vente = "encheres";
                    }
                        
                    else if ($row["Type_de_vente_1"] == "offres" || $row["Type_de_vente_2"] == "offres")
                    {
                        $offreAccepted = mysqli_query($db_handle,'SELECT Prix FROM offres WHERE ID_Item=' . $row["ID"] .' AND ID_Acheteur=' . $ID_Acheteur .' AND Accepted=1 ORDER BY Date DESC');
                        
                        if (!$offreAccepted)
                        die ("Erreur lors de la requète");
                        
                        if (!empty($offreAccepted))
                        {
                            $prixOffre = $offreAccepted->fetch_assoc()["Prix"];
                            $PrixArticle = ($prixOffre<$PrixArticle?$prixOffre:$PrixArticle);
                            $type_de_vente = "offres";
                        }
                            
                    }
                    else if ($row["Type_de_vente_2"] == "encheres")
                    {
                        if (date('Y-m-d h:i:s', strtotime($row["Date_MEV"]. ' + 7 days')) < date('Y-m-d h:i:s', time()))
                        {
                            $MeilleureEnchere = mysqli_query($db_handle,'SELECT MAX(Prix_Max) as "PrixMax" FROM encheres WHERE ID_Item=' . $row["ID"] .' AND ID_Acheteur=' . $ID_Acheteur);
                            
                            if (!$MeilleureEnchere)
                                die ("Erreur lors de la requète");
                                
                            if (!empty($MeilleureEnchere))
                            {
                                $MeilleureEnchere = $MeilleureEnchere->fetch_assoc()["PrixMax"];
                                
                                if ($MeilleureEnchere["PrixMax"] >= $row["Prix_Encheres"])
                                {
                                    $PrixArticle = $row["Prix_Encheres"];
                                    $type_de_vente = "encheres";
                                }
                            }
                        }
                    }
                    
                    echo '<input type="number" name="ID_Item'.$nbItem.'" value="'.$row["ID"].'" style="display: none" \>';
                    echo '<input type="number" name="ID_Vendeur'.$nbItem.'" value="'.$row["ID_Vendeur"].'" style="display: none" \>';
                    echo '<input type="text" name="Type_de_vente'.$nbItem.'" value="'.$type_de_vente.'" style="display: none" \>';
                    echo '<input type="number" name="Quantite'.$nbItem.'" value="'.$Quantite.'" style="display: none" \>';
                    echo '<input type="number" name="QuantiteTotal'.$nbItem.'" value="'.$row["Quantite"].'" style="display: none" \>';
                    echo '<input type="number" name="Montant'.$nbItem.'" value="'.$PrixArticle.'" style="display: none" \>';
                    echo '<input type="number" name="Prix_livraison'.$nbItem.'" value="'.$row["Frais_de_port"].'" style="display: none" \>';
                    
                    echo '<td>
                            <div style="margin-left: 1em">
                                <strong>'.$row["Nom"].'</strong>
                                <hr>
                                <div style="margin-left: 2em">
                                    Quantité : '.$Quantite.'
                                </div>
                            </div>
                         </td>
                         <td style="text-align: center;">
                            <div  style="margin-left: 3em;">
                                Prix : '.$PrixArticle.'€<br>
                                '.$row["Type_livraison"].'<br>
                                Frais de port : '.$row["Frais_de_port"].'€<br>
			                    <button><a href="../Produit/supprimerDuPanier.php?id1='.$row["ID"].'&id2='.$ID_Acheteur.'">Supprimer</a>
                            </div>
                         </td>
                   </tr>';
                   $nbItem += 1;
                }
                echo '<input type="number" name="nbItems" value="'.$nbItem.'" style="display: none" \>';
            ?>
		</table>
	</div>
	</form>
</body>
</html>