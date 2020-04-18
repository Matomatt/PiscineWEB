<?php
	include '../header.php';
?>

<!DOCTYPE html>
<html>
<!-- sources : 
	index.html de Accueil : header et footer, articles similaires
	https://www.w3schools.com/bootstrap4/bootstrap_navs.asp : description
	https://www.w3schools.com/bootstrap4/bootstrap_collapse.asp : description
-->
<head>
	<!--accents-->
	<meta charset="UTF-8">
	<!--reseting my viewport, for making my website responsive-->
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<!-- importing bootstrap-->
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<!--external style sheet-->
	<link href="styles.css" rel="stylesheet" type="text/css">
	<!-- external java sheet-->
	<script type="text/javascript" src="accueil.js"></script>

	<title>Page Produit - ECEbay</title>

	<script type="text/javascript">
		function ajouterAuPanier(id1, id2)
		{
			alert("../Produit/ajouterAuPanier.php?id1=" + id1 + "&id2=" + id2 + "&qt=" + getQuantite());
			window.location.href = "../Produit/ajouterAuPanier.php?id1=" + id1 + "&id2=" + id2 + "&qt=" + getQuantite();
		}
		function getQuantite()
		{
			return document.getElementById("qt").value;
		}
	</script>
</head>
<body>
	<!-- 2eme div : retour aux r�sultats-->
	<div id="div2">
		<h6><a href="javascript:history.back()"><- Retour aux résultats</a></h6>
	</div>
	<br>
	<!-- 3eme div : pr�sentation produits et info vendeur-->
	<div id="div3">
		<h4>Article</h4>	
		<br>
		<div class="wrapper container">
		<br>
			<div class="row">
				<!-- images article-->
	  			<div class="col-6">
	  				<!-- carroussel-->
					<div id="carroussel" class="carousel slide container-fluid" data-ride="carousel">
						<!-- indicateur slide-->
	  					<ul class="carousel-indicators">
	    					<li data-target="#carroussel" data-slide-to="0" class="active"></li>
	    					<li data-target="#carroussel" data-slide-to="1"></li>
	  					</ul>
			  			<!--contenu slide du d�but-->
			  			<div class="carousel-inner">

						<?php
							$db_handle = mysqli_connect('localhost', 'root', '');
							$db_found = mysqli_select_db($db_handle, 'ecebay');

							if (!$db_found) { die('Database not found'); }

							$id = isset($_GET["id"])?$_GET["id"]:"";
							$first = 0;
							$imgs = mysqli_query($db_handle, "SELECT File FROM medias WHERE ID_Item=" . $id . " ORDER BY indx ASC;");
							while($img = $imgs->fetch_assoc()) {
								if ($first == 0)
								{
									echo '<div class="carousel-item active">
			      							<img class="img-fluid" src="../UploadedContent/' . $img["File"] . '" alt="photo">
										</div>';
									$first = 1;
								}
								else
									echo '<div class="carousel-item">
			      							<img class="img-fluid" src="../UploadedContent/' . $img["File"] . '" alt="photo">
										</div>';
							}
						?>

			  			</div>
			  			<!--contr�le droit et gauche -->
			  			<a class="carousel-control-prev" href="#carroussel" data-slide="prev">
			    		<span class="carousel-control-prev-icon"></span>
			  			</a>
			  			<a class="carousel-control-next" href="#carroussel" data-slide="next">
			    		<span class="carousel-control-next-icon"></span>
			  			</a>
					</div>
				</div>
				<!--Pr�sentation produit, vendeur, son �tat et mode de paiment-->
	  			<div class="col-6">
					<table>
						<?php
						    $ID_Acheteur = isset($_SESSION["UserID"]) && isset($_SESSION["UserType"])?($_SESSION["UserType"] == "Acheteur"?$_SESSION["UserID"]:""):"";
						
						    echo 'ID acheteur : ' . $ID_Acheteur;
							$db_handle = mysqli_connect('localhost', 'root', '');
							$db_found = mysqli_select_db($db_handle, 'ecebay');

							if (!$db_found) { die('Database not found'); }
							
							$id = isset($_GET["id"])?$_GET["id"]:"";
							$first = 0;
							$item = mysqli_query($db_handle, "SELECT * FROM items WHERE ID=" . $id . ";")->fetch_assoc();

							$nbLikes = mysqli_query($db_handle, 'SELECT COUNT( * ) as "Number of Rows" FROM wishlists WHERE ID_Item = ' . $id . ';')->fetch_assoc()["Number of Rows"];

							echo '<tr>
									<th>'. $item["Nom"] . '<br>
									<button class="btn btn-danger" type="submit"> &#x2661; </button> ('. $nbLikes . ' &#x2661;)</th>
								</tr>';

							$boutique = mysqli_query($db_handle, 'SELECT Boutique FROM vendeurs WHERE ID="' . $item["ID_Vendeur"] . '";')->fetch_assoc()["Boutique"];
							$moyenneNotes = mysqli_query($db_handle, 'SELECT AVG( Note ) as "moyenne" FROM notes WHERE ID_Vendeur = ' . $item["ID_Vendeur"] . ';')->fetch_assoc()["moyenne"];
							
							echo '<tr>
									<td>Vendu par : <a href="../Vendeur/pagevendeur.html?id='. $item["ID_Vendeur"] . '"> ' . $boutique . '</a> ('. (int)$moyenneNotes/2 . '&#9733;)</td>
								</tr>';
							
							echo '<tr>
									<td>Etat : ' . $item["Etat"] . '</td>
								</tr>';
							if ($item["Type_de_vente_1"] == "achat_imm")
							{
								echo '<tr>
										<td>Prix : ' . $item["Prix"] . '€ </td>
									</tr>
									<tr>
										<td><button class="btn btn-primary" type="submit">Achat immédiat</button></td>
									</tr>';
								
									$dejaDansLePanier = mysqli_query($db_handle, 'SELECT Quantite FROM paniers WHERE ID_Item="' . $item["ID"] . '" AND ID_Acheteur =' . $ID_Acheteur . ';');
									
									if ($dejaDansLePanier)
									{
									    $dejaDansLePanier = $dejaDansLePanier->fetch_assoc();
									    if (empty($dejaDansLePanier))
									    {
									        echo'<tr>
												<td>Quantité : <input type="number" min="1" max="' . $item["Quantite"] . '" id="qt"></td>
											</tr>';
									        if ($ID_Acheteur != "")
									        {
									            echo'<tr>
    												<td><a href="javascript:ajouterAuPanier(' . $item["ID"] . ', ' . $ID_Acheteur . ');" > Ajouter au panier </a></td>
    											</tr>';
									        }
									        else
									            echo'<tr>
    												<td><a href="../CreerCompte/connexion.php?idItem=' . $item["ID"] . '" > Ajouter au panier </a></td>
    											</tr>';
									            
									    }
									    else
									    {
									        echo'<tr>
												<td> <a href="../Acheteur/panier.php"> ' . $dejaDansLePanier["Quantite"] . ' déjà dans le panier </a></td>
											</tr>';
									    }
									}
									
								
							}
							
							if ($item["Type_de_vente_1"] == "encheres" || $item["Type_de_vente_2"] == "encheres")
							{
							    //<button class="btn btn-primary navbar-toggler" data-toggle="collapse" data-target="#encherir" onclick="location.href=\'../Encheres/index.php?id=' . $item["ID"] . '&e=' . $item["Prix_Encheres"] . '\';">Enchérir</button></td>
								echo '<tr>
										<td><button class="btn btn-primary toggler" data-toggle="collapse" data-target="#encherir">Enchérir</button>
        								    <div class="collapse" id="encherir" style="text-align: center; box-shadow: 0px 2px 6px 0px #000000;">
                                            <form method="post" action="encherir.php?id1='. $id .'&id2='. $ID_Acheteur .'">
                                            	<h4>Enchérir</h4>
                                            	Enchère maximale actuelle : ' . $item["Prix_Encheres"] . '<br>
    											Votre enchère : <input type="number" name="enchere" min="'. ($item["Prix_Encheres"]+1) .'"></input>€ <br><br>' .
    											(($ID_Acheteur!="")?'<button type="submit">Valider</button></form>':'</form><button onclick="window.location.href=\'../CreerCompte/connexion.php?idItem=' . $item["ID"] . '\'">Valider</button>') .
									   '</div></td>
                                     </tr>';
							}
							if ($item["Type_de_vente_1"] == "offres" || $item["Type_de_vente_2"] == "offres")
							{
								echo '<tr>
										<td><a class="toggler" data-toggle="collapse" data-target="#offrir" href="../Offres/index.php?id=' . $item["ID"] . '">Faire une offre</a>
                                            <div class="collapse" id="offrir" style="text-align: center; box-shadow: 0px 2px 6px 0px #000000;">
                                            <form method="post" action="faireOffre.php?id1='. $id .'&id2='. $ID_Acheteur .'">
                                            	<h4>Votre offre</h4>
    											<input type="number" name="offre" min="0" style="margin-left: 1em"></input>€ <br>' .
    											(($ID_Acheteur!="")?'<button type="submit">Valider</button></form>':'</form><button onclick="window.location.href=\'../CreerCompte/connexion.php?idItem=' . $item["ID"] . '\'">Valider</button>') .
                                        	'</div></td>
									</tr>';
							}
						?>
								
					</table>			
	  			</div>
			</div>
			<!--4eme div : descripttion produit-->
			<div id="div4">
				<!-- Nav tabs -->
				<ul class="nav nav-tabs">
  					<li class="nav-item">
    					<a class="nav-link " data-toggle="tab" href="#description"><button data-toggle="collapse" data-target="#demo">Description</button></a>
  					</li>
				</ul>
				<br>
				<!-- Tab panes -->
				<div class="tab-content">
					<div class="tab-pane container active" id="description">
						<div id="demo" class="collapse">
							Le vendeur assume l'entière responsabilité de cette annonce.
							<br>
							Caractéristiques de l'objet
							<br>
							Etat :	Occasion : Objet ayant été utilisé. 
							<br>
							Catégorie:	Accessoire VIP
							<br>
							Marque:	Bla	
						</div>
					</div>
				</div>
			</div>	
		</div>
	</div>
	<br>
	
	<br>
	<!--5eme div : produits similaires-->
	<div id="div5">
		<h4>Articles similaires</h4>	
		<br>	
		<!-- .card-deck cr�er des grilles de taille automatique suivant le nombre d'articles-->
		<div class="card-deck">
			<!--un article-->
  			<div class="card bg-basic">
  				<img class="card-img-top" src="../Images/caddie.jpg" alt="Card image">
    			<div class="card-body text-center">
      				<h4 class="card-title">Caddie</h4>
    				<p class="card-text">Prix : inconnu</p>
    				<a href="#" class="btn btn-primary">En savoir plus</a>
    			</div>
  			</div>
  			<!--un article-->
  			<div class="card bg-basic">
  				<img class="card-img-top" src="../Images/caddie.jpg" alt="Card image">
    			<div class="card-body text-center">
      				<h4 class="card-title">Pyjama</h4>
    				<p class="card-text">Prix : 100�</p>
    				<a href="#" class="btn btn-primary">En savoir plus</a>
    			</div>
  			</div>
  			<!--un article-->
  			<div class="card bg-basic">
  				<img class="card-img-top" src="../Images/caddie.jpg" alt="Card image">
    			<div class="card-body text-center">
      				<h4 class="card-title">Caddie</h4>
    				<p class="card-text">Prix : inconnu</p>
    				<a href="#" class="btn btn-primary">En savoir plus</a>
    			</div>
  			</div>
  			<!--un article-->
  			<div class="card bg-basic">
  				<img class="card-img-top" src="../Images/caddie.jpg" alt="Card image">
    			<div class="card-body text-center">
      				<h4 class="card-title">Pyjama</h4>
    				<p class="card-text">Prix : 100�</p>
    				<a href="#" class="btn btn-primary">En savoir plus</a>
    			</div>
  			</div>
  			<!--un article-->
  			<div class="card bg-basic">
  				<img class="card-img-top" src="../Images/caddie.jpg" alt="Card image">
    			<div class="card-body text-center">
      				<h4 class="card-title">Caddie</h4>
    				<p class="card-text">Prix : inconnu</p>
    				<a href="#" class="btn btn-primary">En savoir plus</a>
    			</div>
  			</div>
  		</div>
	</div>
	<br>
	<hr>
	<br>
	<!--6eme div : pied de page-->
	<div id="div6">
		<?php
			include '../footer.html';
		?>
	</div>

</body>
</html>