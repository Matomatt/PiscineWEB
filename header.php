<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" >
<!-- barre de navigation avec bouttons et barre de recherche-->
<nav class="navbar navbar-expand-sm bg-basic navbar-basic "> 
	<!--placement logo-->
	<a class="navbar-brand" href="#"> 
		<img class="img-fluid" src="../Images/logo.png" onclick="location.href='../Accueil/index.php';" style="max-width: 8em;">
	</a>
	<!-- bouton explorer par cat�gories-->
	<ul class="navbar-nav">
		<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" href="../ResultatsDeRecherche/index.php" id="navbardrop" data-toggle="dropdown">Explorer par catégories
			</a>
			<div class="dropdown-menu">
			<?php
					$db_handle = mysqli_connect('localhost', 'root', '');
					if (!mysqli_select_db($db_handle, 'ecebay')) { die('Database not found'); }

					$queryCategories = "SELECT * FROM categories";
					$resultCategories = mysqli_query($db_handle, $queryCategories);

					if ($resultCategories)
					{
						if (mysqli_num_rows($resultCategories) > 0)
						{
							while($row = $resultCategories->fetch_assoc()) {
								echo '<a class="dropdown-item" href="../ResultatsDeRecherche/index.php?categorie=' . $row["ID"] . '">' . $row["Nom"] . '</a>';
							}
						}
					}
				?>
			</div>
		</li>
	</ul>
	<!--barre de recherche et boutons associ�s-->
	<form class="form-inline" action="../ResultatsDeRecherche/index.php" method="post">
		<div class="input-group">
			<!-- barre de recherche-->
			<?php
				if (isset($_POST["rechercher"]))
				{
					echo '<input class="form-control mr-sm-2" type="text" name="rechercher"' . ($_POST["rechercher"]!=""? 'value="' .  $_POST["rechercher"]:'placeholder="Rechercher"') . '">';
				}
				else
				{
					echo '<input class="form-control mr-sm-2" type="text" name="rechercher" placeholder="Rechercher">';
				}
			?>
			<!-- bouton cat�gories dans recherche-->
			<select class="custom-select" name="categorie">
				<option selected value="none">Toutes les catégories</option>
				<?php
					$db_handle = mysqli_connect('localhost', 'root', '');
					if (!mysqli_select_db($db_handle, 'ecebay')) { die('Database not found'); }

					$queryCategories = "SELECT * FROM categories";
					$resultCategories = mysqli_query($db_handle, $queryCategories);

					if ($resultCategories)
					{
						if (mysqli_num_rows($resultCategories) > 0)
						{
							while($row = $resultCategories->fetch_assoc()) {
								echo '<option value="' . $row["ID"] . '">' . $row["Nom"] . '</option>';
							}
						}
					}
				?>
			</select>
			<!-- bouton pour rechercher-->
			<button class="btn btn-primary" type="submit">Rechercher</button>
		</div>
	</form>
	<!-- boutons de panier et de connexion-->
	<input type="image" class="img-fluid" src="../Images/caddie.jpg" onclick="location.href='../Acheteur/panier.html';" style="margin: 1em; max-width: 4em;"></input>

	<?php
		session_start();
		if (isset($_SESSION['UserType']) && isset($_SESSION['UserID']))
		{
			if ($_SESSION['UserType'] == "Acheteur")
				echo '<input type="image" class="img-fluid" src="../Images/user-default.png" onclick="location.href=\'../Acheteur/compteclient.php\';" style="max-width: 4em;"></input>';
			else if ($_SESSION['UserType'] == "Vendeur")
				echo '<input type="image" class="img-fluid" src="../Images/user-default.png" onclick="location.href=\'../Vendeur/comptevendeur.php\';" style="max-width: 4em;"></input>';
			else if ($_SESSION['UserType'] == "Admin")
				echo '<input type="image" class="img-fluid" src="../Images/user-default.png" onclick="location.href=\'../Admin/compteadmin.html\';" style="max-width: 4em;"></input>';
			else
				echo '<button class="btn" onclick="location.href=\'../CreerCompte/connexion.php\';">Connexion</button>';
		}
		else
			echo '<button class="btn" onclick="location.href=\'../CreerCompte/connexion.php\';">Connexion</button>';
	
	?>
</nav>
<hr style="border: 1px solid lightgrey;">
