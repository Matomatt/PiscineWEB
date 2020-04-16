<!DOCTYPE html>
<html>

<!-- sources : 
	https://www.ebay.fr/ : style de la page
	https://www.w3schools.com/bootstrap4/bootstrap_jumbotron.asp : fond gris
	https://www.w3schools.com/bootstrap4/bootstrap_button_groups.asp : menu défilant
	https://www.w3schools.com/bootstrap4/bootstrap_navbar.asp : barre de recherche
	https://www.w3schools.com/bootstrap4/bootstrap_cards.asp : pour les produits
	https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.cncc.com%2Fle-cncc-met-en-place-un-comite-executif-enseignes%2Fpicto-caddie-redim%2F&psig=AOvVaw3VE0GWHIwwupvyvYfdv8vJ&ust=1586944794585000&source=images&cd=vfe&ved=0CAMQjB1qFwoTCKjEuJvU5-gCFQAAAAAdAAAAABAD : image caddie
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

	<title>Ebay ECE</title>
</head>
<body>
	<!-- 1er div : barre de navigation avec bouttons et barre de recherche-->
	<div id="div1"> 
		<!--barre de navigation-->
  		<nav class="navbar navbar-expand-sm bg-basic navbar-basic "> 
  			<!--placement logo-->
  			<a class="navbar-brand" href="#"> 
    			<button><img class="img-fluid" id="logo" src="../Images/logo.png"></button>
  			</a>
  			<!-- bouton explorer par catégories-->
  			<ul class="navbar-nav">
        	    <li class="nav-item dropdown">
      				<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Explorer par catégories
      				</a>
      				<div class="dropdown-menu">
        				<a class="dropdown-item" href="#">Ferraille/Trésor</a>
        				<a class="dropdown-item" href="#">Bon pour le Musée</a>
        				<a class="dropdown-item" href="#">Accessoire VIP</a>
      				</div>
    			</li>
  			</ul>
  			<!--barre de recherche et boutons associés-->
  			<form class="form-inline" action="../ResultatsDeRecherche/index.php" method="post">
  				<div class="input-group mb-3">
  					<!-- barre de recherche-->
    				<input class="form-control mr-sm-2" type="text" placeholder="Rechercher" name="rechercher">
    				<!-- bouton catégories dans recherche-->
  					<select class="custom-select">
   						<option selected>Toutes les catégories</option>
    					<option value="ferraille/tresor">Ferraille/Trésor</option>
    					<option value="musee">Bon pour le Musée</option>
    					<option value="vip">Accessoire VIP</option>
  					</select>
  					<!-- bouton pour rechercher-->
    				<button class="btn btn-primary" type="submit">Rechercher</button>
    			</div>
    			<!-- boutons de panier et de connexion-->
    			<button type="button" class="btn btn-light"><img class="img-fluid" id="caddie" src="../Images/caddie.jpg" onclick="location.href='../Acheteur/panier.html';"></button>
    			<button type="button" class="btn btn-light" onclick="location.href='../CreerCompte/connexion.html';">Connexion</button>
  			</form>
		</nav>
	</div>
	<hr>
	<div id="div2"><!--barre catégories, achat,vente-->
		<div class="nav justify-content-center">
			<button type="button" class="btn btn-light" onclick="location.href='../ResultatsDeRecherche/index.php';">Acheter</button>
			<button type="button" class="btn btn-light">Vendre</button>
			<button type="button" class="btn btn-light" onclick="location.href='../ResultatsDeRecherche/index.php?FerOuTres';">Ferraille/Trésor</button>
			<button type="button" class="btn btn-light" onclick="location.href='../ResultatsDeRecherche/index.php?BonMusee';">Bon pour le Musée</button>
			<button type="button" class="btn btn-light" onclick="location.href='../ResultatsDeRecherche/index.php?AccesVip';">Accessoire VIP</button>
		</div>
	</div>
	<hr>
	<!-- 2eme div : carroussel-->
	<div id="div3">
		<!-- carroussel-->
		<div id="carroussel" class="carousel slide container-fluid text-center" data-ride="carousel">
			<!-- indicateur slide-->
  			<ul class="carousel-indicators">
    			<li data-target="#carroussel" data-slide-to="0" class="active"></li>
    			<li data-target="#carroussel" data-slide-to="1"></li>
  			</ul>
  			<!--contenu slide du début-->
  			<div class="carousel-inner">
   				<div class="carousel-item active">
      				<img class="img-fluid" src="../Images/caddie.jpg" alt="Pub">
      				<!--ajout légende sur image-->
      				<div class="carousel-caption">
    					<h3>Logo</h3>
    					<p>Commandez comme sur Ebay</p>
  					</div>
    			</div>
    			<!--contenu slide-->
    			<div class="carousel-item">
      				<img class="img-fluid" src="../Images/caddie.jpg" alt="Pub">
      				<!--ajout légende sur image-->
      				<div class="carousel-caption">
    					<h3>Caddie</h3>
    					<p>Ajouter ce que vous voulez</p>
  					</div>
    			</div>
  			</div>
  			<!--contréle droit et gauche -->
  			<a class="carousel-control-prev" href="#carroussel" data-slide="prev">
    		<span class="carousel-control-prev-icon"></span>
  			</a>
  			<a class="carousel-control-next" href="#carroussel" data-slide="next">
    		<span class="carousel-control-next-icon"></span>
  			</a>

		</div>
	</div>
	<br>
	<br>
	<!-- 4eme div : dernières enchères-->
	<div id="div4">
		<h4>Dernières enchères</h4>	
		<br>	
		<!-- .card-deck créer des grilles de taille automatique suivant le nombre d'articles-->
		<div class="card-deck">
			<!--un article-->
  			<div class="card bg-basic">
  				<img class="card-img-top" src="../Images/caddie.jpg" alt="Card image">
    			<div class="card-body text-center">
      				<h4 class="card-title">Caddie</h4>
    				<p class="card-text">Prix enchères : inconnu</p>
    				<a href="#" class="btn btn-primary">En savoir plus</a>
    			</div>
  			</div>
  			<!--un article-->
  			<div class="card bg-basic">
  				<img class="card-img-top" src="../Images/caddie.jpg" alt="Card image">
    			<div class="card-body text-center">
      				<h4 class="card-title">Pyjama</h4>
    				<p class="card-text">Prix enchères : 100€</p>
    				<a href="#" class="btn btn-primary">En savoir plus</a>
    			</div>
  			</div>
  			<!--un article-->
  			<div class="card bg-basic">
  				<img class="card-img-top" src="../Images/caddie.jpg" alt="Card image">
    			<div class="card-body text-center">
      				<h4 class="card-title">Caddie</h4>
    				<p class="card-text">Prix enchères : inconnu</p>
    				<a href="#" class="btn btn-primary">En savoir plus</a>
    			</div>
  			</div>
  			<!--un article-->
  			<div class="card bg-basic">
  				<img class="card-img-top" src="../Images/caddie.jpg" alt="Card image">
    			<div class="card-body text-center">
      				<h4 class="card-title">Pyjama</h4>
    				<p class="card-text">Prix enchères : 100€</p>
    				<a href="#" class="btn btn-primary">En savoir plus</a>
    			</div>
  			</div>
  			<!--un article-->
  			<div class="card bg-basic">
  				<img class="card-img-top" src="../Images/caddie.jpg" alt="Card image">
    			<div class="card-body text-center">
      				<h4 class="card-title">Caddie</h4>
    				<p class="card-text">Prix enchères : inconnu</p>
    				<a href="#" class="btn btn-primary">En savoir plus</a>
    			</div>
  			</div>
  		</div>		
	</div>
	<br>
	<br>
	<!--5eme div : Nouveautés-->
	<div id="div5">
		<h4>Nouveautés</h4>	
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
    				<p class="card-text">Prix : 100€</p>
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
    				<p class="card-text">Prix : 100€</p>
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
	
	<hr>
	<!--dernier div : pied de page-->
	<div id="div6">
		<footer class="page-footer">
 			<div class="container">
				<div class="row">
					<div class="col-lg-8 col-md-8 col-sm-12">
						<h6 class="text-uppercase font-weight-bold">Information additionnelle</h6>
						<p>
						Le site web ECEbay est un projet piscine étudiant fait lors de la semaine piscine d'ING3 Promo 2022 dans le cadre du module de Web Dynamique.
						</p>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-12">
						<h6 class="text-uppercase font-weight-bold">Contact</h6>
						<p>
						37, quai de Grenelle, 75015 Paris, France <br>
						info@webDynamique.ece.fr <br>
						+33 01 02 03 04 05 <br>
						+33 01 03 02 05 04
			 			</p>
			 		</div>
 				</div>
 				<br>
				<div class="footer-copyright text-center">
					<small>&copy; 2020 Copyright | Droit d'auteur: Bocher Célia, Cadot Léonie, Gaucher Matthieu</small>
				</div>
			</div>
		</footer>
	</div>
</body>
</html>