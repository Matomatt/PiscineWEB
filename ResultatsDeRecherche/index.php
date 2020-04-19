<?php
	echo '<div class="container">';
	include '../header.php';
	echo '</div>';
?>

<html>

<head>
	<title>ECEbay</title>
    <!--accents-->
	<meta charset="UTF-8">
	<!--reseting my viewport, for making my website responsive-->
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<!-- importing bootstrap-->
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<!--external style sheet-->
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>
	<div class="container layout">
		<div class="row">
			<nav class="navbar navbar-expand-lg">
				<button class="navbar-toggler navbar-light" type="button" data-toggle="collapse" data-target="#filters">
            		<span class="navbar-toggler-icon"></span>
        		</button>
				<div class="collapse navbar-collapse" id="filters">
					<form action="index.php" method="post">
						<h4>Filtres</h4>
						<table>
							<?php
								echo '<tr>
									<td>
									<h6>Types de vente</h6>
									<table id="typeVenteFilter">
									<tr>';
							
								echo '<td><input type="radio" value="tout"' . (isset($_POST["bt"])?(($_POST["bt"]=="tout")? 'checked="checked"':''):'checked="checked"') . 'name="bt"> Tout </td>';
								echo '<td><input type="radio" value="achat_imm"' . (isset($_POST["bt"])?(($_POST["bt"]=="achat_imm")? 'checked="checked"':''):'') . 'name="bt"> Achats immediat </td>';
								
								echo '</tr>
									  <tr>';
								
								echo '<td><input type="radio" value="encheres"' . (isset($_POST["bt"])?(($_POST["bt"]=="encheres")? 'checked="checked"':''):'') . 'name="bt"> Encheres </td>';
								echo '<td><input type="radio" value="offres"' . (isset($_POST["bt"])?(($_POST["bt"]=="offres")? 'checked="checked"':''):'') . 'name="bt"> Offres </td>';
								
								echo '</tr>
									</table>
									</td>
								</tr>
								<tr>
									<td id="categorieList">
										<h6>Categories</h6>';
								
										$categorie = (isset($_GET["categorie"])?htmlspecialchars($_GET["categorie"]):(isset($_POST["categorie"])?$_POST["categorie"]:"none"));
									
										$db_handle = mysqli_connect('localhost', 'root', '');
										$db_found = mysqli_select_db($db_handle, 'ecebay');

										if (!$db_found) { die('Database not found'); }

										$query = "SELECT * FROM categories";
										$result = mysqli_query($db_handle, $query);

										if (!$result)
										{
											die('Couldn\'t find table');
										}
										
										if (mysqli_num_rows($result) < 1)
										{
											die('Empty');
										}

										while($row = $result->fetch_assoc()) {
											echo '<input type="checkbox" value="true" name="' . $row["ID"] . '" ' . ($categorie == $row["ID"]?'checked="checked"':(isset($_POST[$row["ID"]])?(($_POST[$row["ID"]] == "true")? 'checked="checked"':''):'')) . '> ' . $row["Nom"] . ' <br>';
										}

								echo '</td>
							</tr>';
								
							?>
							<tr> <td align="center"><br><input type="submit" name="Rechercher" value="Rechercher"></td> </tr>
						</table>
					</form>
				</div>
			</nav>
			<div class="col-lg-9">
					<h3 class="feature-title">Items en vente</h3>
					<?php 
						$db_handle = mysqli_connect('localhost', 'root', '');
						$db_found = mysqli_select_db($db_handle, 'ecebay');

						if (!$db_found) { die('Database not found'); }

						$query = "SELECT * FROM items WHERE (Vendu=0)";

						if (isset($_POST["rechercher"]))
						{
							if ($_POST["rechercher"] != "")
								$query = $query . ' AND ( Nom LIKE \'%' . $_POST["rechercher"] . '%\' OR Description LIKE \'%' . $_POST["rechercher"] . '%\')';
						}

						if (isset($_POST["bt"]))
						{
							if ($_POST["bt"] != "tout")
							{
								if ($_POST["bt"] == "achat_imm")
								{
									$query = $query . ' AND (Type_de_vente_1 = "achat_imm" OR Type_de_vente_2 = "achat_imm")';
								}
								else if ($_POST["bt"] == "encheres")
								{
									$query = $query . ' AND (Type_de_vente_1 = "encheres" OR Type_de_vente_2 = "encheres")';
								}
								else if ($_POST["bt"] == "offres")
								{
									$query = $query . ' AND (Type_de_vente_1 = "offres" OR Type_de_vente_2 = "offres")';
								}
							}
							
						}

						$categorie = (isset($_GET["categorie"])?htmlspecialchars($_GET["categorie"]):(isset($_POST["categorie"])?$_POST["categorie"]:"none"));

						if ($categorie != "none")
						{
							$query .= ' AND (Categorie="' . $categorie .'");';
						}
						else
						{
							$queryCategories = "SELECT * FROM categories";
							$resultCategories = mysqli_query($db_handle, $queryCategories);

							if ($resultCategories)
							{
								if (mysqli_num_rows($resultCategories) > 0)
								{
									$toAdd = " AND (";
									while($row = $resultCategories->fetch_assoc()) {
										if (isset($_POST[$row["ID"]]))
										{
											if ($_POST[$row["ID"]] == "true")
											{
												$toAdd = $toAdd . ((strlen($toAdd) > 6)?' OR (':' (') . 'Categorie="' . $row["ID"] . '")';
											}
										}
									}
									if (strlen($toAdd) > 6)
									{
										$query .= $toAdd . ")";
									}
								}
							}
						}

						$result = mysqli_query($db_handle, $query);

						if (!$result)
						{
							die('Couldn\'t find table');
						}
						
						if (mysqli_num_rows($result) < 1)
						{
							die('None');
						}

						echo "<table>";
						while($row = $result->fetch_assoc()) {
							echo "<tr> <td align='center'>";
							$img = mysqli_query($db_handle, "SELECT File FROM medias WHERE ID_Item=" . $row["ID"] . " AND indx = 0;")->fetch_assoc() ["File"];
							echo '<input type="image" class="img-fluid" onclick="location.href=\'../Produit/index.php?id=' . $row["ID"] . '\';" src="../UploadedContent/' . (($img!="") ? $img : 'blank.png') . '" style="max-width: 13em; max-height: 10em"> </input> </td> <td align="center">' . $row["Nom"] . "<br> $" . $row["Prix"] . '</td>';
							
							echo '<td  align="center"><form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
									<input type="hidden" name="cmd" value="_xclick">
									<input type="hidden" name="business" value="gauchermatthieu918@gmail.com">
									<input type="hidden" name="lc" value="US">
									<input type="hidden" name="item_name" value="' . $row["Nom"] . '">
									<input type="hidden" name="item_number" value="' . $row["ID"] . '">
									<input type="hidden" name="amount" value="' . $row["Prix"] . '">
									<input type="hidden" name="currency_code" value="EUR">
									<input type="hidden" name="button_subtype" value="services">
									<input type="hidden" name="no_note" value="0">
									<input type="hidden" name="tax_rate" value="0.000">
									<input type="hidden" name="shipping" value="0.00">
									<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynowCC_LG.gif:NonHostedGuest">
									<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
									<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
									</form>';
							echo "</td> </tr>";
							echo "<tr> <td> <br> </td> </tr>";
						}
						echo "</table>";
					?>
			</div>
		</div>
		
	</div>
</body>

</html>