
<?php
	include '../header.php';
?>

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
	<link href="styles.css" rel="stylesheet" type="text/css">

	<title>ECEbay</title>
</head>

<body>
	<!--barre catégories, achat,vente-->
	<div class="nav justify-content-center" style="background-color: lightgrey; padding:13px;">
		<button type="button" class="btn btn-light" onclick="location.href='../ResultatsDeRecherche/index.php';">Acheter</button>
		<button type="button" class="btn btn-light">Vendre</button>
		<button type="button" class="btn btn-light" onclick="location.href='../ResultatsDeRecherche/index.php?categorie=FerOuTres';">Ferraille/Trésor</button>
		<button type="button" class="btn btn-light" onclick="location.href='../ResultatsDeRecherche/index.php?categorie=BonMusee';">Bon pour le Musée</button>
		<button type="button" class="btn btn-light" onclick="location.href='../ResultatsDeRecherche/index.php?categorie=AccesVIP';">Accessoire VIP</button>
	</div>
	<hr>
	<!-- 2eme div : carroussel-->
	<div id="div3">
		<!-- carroussel-->
		<div id="carroussel" class="carousel slide container-fluid text-center" data-ride="carousel">
      <div class="carousel-inner" style="background-color: lightgrey;">
        <?php
          
          $db_handle = mysqli_connect('localhost', 'root', '');
          $db_found = mysqli_select_db($db_handle, 'ecebay');

          if (!$db_found) { die('Database not found'); }
          /*on récupère les données de la table items*/
          $query = "SELECT * FROM items ORDER BY Date_MEV DESC";
          $result = mysqli_query($db_handle, $query);

          if (!$result)
          {
            die('Couldn\'t find table');
          }
                        
          if (mysqli_num_rows($result) < 1)
          {
            die('Empty');
          }        

          $first = 0;                   

          while($row = $result->fetch_assoc()) 
          {
            /*on récupère les données de la table medias*/
            $img = mysqli_query($db_handle, "SELECT File FROM medias WHERE ID_Item=" . $row["ID"] . " AND indx = 0;")->fetch_assoc() ["File"];

            if ($first == 0)
            {
              /*affichage 1ere image*/
              echo '<div class="carousel-item active">
                      <img class="img-fluid" alt="Article" style="width: 26em; height: 23em; object-fit:contain; background: lightgrey;" src="../UploadedContent/' . (($img!="") ? $img : 'blank.png') . '">
                    </div>';
              $first = 1;
            }

            else
            {
              /*affichage autres images*/
              echo '<div class="carousel-item">
                      <img class="img-fluid" alt="Article" style="width: 26em; height: 23em; object-fit: contain; background: lightgrey;" src="../UploadedContent/' . (($img!="") ? $img : 'blank.png') . '">
                    </div>';
            }             
          }               
        ?>
  		</div>
  		<!--contrôle droit et gauche -->
  		<a class="carousel-control-prev" href="#carroussel" data-slide="prev">
    	<span class="carousel-control-prev-icon"></span>
  		</a>
  		<a class="carousel-control-next" href="#carroussel" data-slide="next" >
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
    <!--.card-deck créer des grilles de taille automatique suivant le nombre d'articles-->
    <div class="card-deck">
      <!-- articles-->
      <?php
        
        $db_handle = mysqli_connect('localhost', 'root', '');
        $db_found = mysqli_select_db($db_handle, 'ecebay');

        if (!$db_found) { die('Database not found'); }
        /*on récupère les données de la table items*/
        $query = "SELECT * FROM items";
        $result = mysqli_query($db_handle, $query);

        if (!$result)
        {
          die('Couldn\'t find table');
        }
                      
        if (mysqli_num_rows($result) < 1)
        {
          die('Empty');
        }

        while($row = $result->fetch_assoc()) 
        {
          if($row["Type_de_vente_1"] == "encheres" OR $row["Type_de_vente_2"] == "encheres")
          {
            echo '<div class="card bg-basic">';
            /*on récupère les données de la table medias*/
            $img = mysqli_query($db_handle, "SELECT File FROM medias WHERE ID_Item=" . $row["ID"] . " AND indx = 0;")->fetch_assoc() ["File"];
            echo '<img class="img-fluid" style="width: auto; height: 16em; object-fit: contain; background: lightgrey;" src="../UploadedContent/' . (($img!="") ? $img : 'blank.png') . '">';
            echo '<div class="card-body text-center">
                    <h4 class="card-title">'.$row["Nom"].'</h4>
                    <p class="card-text">Prix : '.$row["Prix"].'€</p>
                    <p class="card-text">Prix Enchères : '.$row["Prix_Encheres"].'€</p>
                    <a href="../Produit/index.php?id='. $row["ID"].'" class="btn btn-primary">En savoir plus</a>
                  </div>
                </div>';
          }
        }               
      ?>
  	</div>				
	</div>
	<br>
	<br>
	<!--5eme div : Nouveautés-->
	<div id="div5">
		<h4>Nouveautés Achat Immédiat</h4>	
		<br>	
		<!-- .card-deck créer des grilles de taille automatique suivant le nombre d'articles-->
		<div class="card-deck">
			<!--articles-->
      <?php
        
        $db_handle = mysqli_connect('localhost', 'root', '');
        $db_found = mysqli_select_db($db_handle, 'ecebay');

        if (!$db_found) { die('Database not found'); }
        /*on récupère les données de la table items*/
        $query = "SELECT * FROM items ORDER BY Date_MEV DESC";
        $result = mysqli_query($db_handle, $query);

        if (!$result)
        {
          die('Couldn\'t find table');
        }
                      
        if (mysqli_num_rows($result) < 1)
        {
          die('Empty');
        }

        while($row = $result->fetch_assoc()) 
        {
          if($row["Type_de_vente_1"] == "achat_imm" OR $row["Type_de_vente_2"] == "achat_imm")
          {
            echo '<div class="card bg-basic">';
            /*on récupère les données de la table medias*/
            $img = mysqli_query($db_handle, "SELECT File FROM medias WHERE ID_Item=" . $row["ID"] . " AND indx = 0;")->fetch_assoc() ["File"];
            echo '<img class="img-fluid" style="width: auto; height: 16em; object-fit: contain; background: lightgrey;" src="../UploadedContent/' . (($img!="") ? $img : 'blank.png') . '">';
            echo '<div class="card-body text-center">
                    <h4 class="card-title">'.$row["Nom"].'</h4>
                    <p class="card-text">Prix : '.$row["Prix"].'€</p>
                    <a href="../Produit/index.php?id='. $row["ID"].'" class="btn btn-primary">En savoir plus</a>
                  </div>
                </div>';
          }
        }               
      ?>
  	</div>
	</div>
	
	<hr>
	<!--dernier div : pied de page-->
	<div id="div6">
		<?php
			include '../footer.html';
		?>
	</div>
</body>
</html>