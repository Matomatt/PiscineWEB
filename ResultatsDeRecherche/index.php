<?php
		include './../TestHeader.html';
?>

<html>

<head>
	<title>ECEbay</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

	<script type="text/javascript">
	</script>
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
								if (isset($_POST["rechercher"]))
								{
									echo '<input type="text" name="rechercher" value="' .  $_POST["rechercher"] . '" style="visibility=\'hidden\'">';
								}
								else
								{
									echo '<input type="text" name="rechercher" value="" >';
								}
								
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
											echo '<input type="checkbox" value="true" name="' . $row["ID"] . '" ' . (isset($_POST[$row["ID"]])?(($_POST[$row["ID"]] == "true")? 'checked="checked"':''):'') . '> ' . $row["Nom"] . ' <br>';
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
								$query = $query . ' AND ( Nom LIKE \'' . $_POST["rechercher"] . '\' OR Description LIKE \'' . $_POST["rechercher"] . '\')';
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
									$query = $query . $toAdd . ")";
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

						while($row = $result->fetch_assoc()) {
							$img = mysqli_query($db_handle, "SELECT Media1 FROM medias WHERE ID=" . $row["ID_Medias"] . ";")->fetch_assoc() ["Media1"];
							echo '<div class="col-lg-4" style="float: left;"> <img class="img-fluid" src="../Images/' . (($img!="") ? $img : 'blank.png') . '"> </div> <div class="col-lg-8" style="float: left;">' . $row["Nom"] . "<br> $" . $row["Prix"] . " <br> " . $row["Description"] . '</div>';

						}
					?>
			</div>
		</div>
		
	</div>
</body>

</html>