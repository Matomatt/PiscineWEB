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
		$(document).ready(
			function () {
				//alert("nopnop");
				$.ajax({
				url: 'fillpage.php',
				success: function (response) { alert(response); } 
				});
				
			});
	</script>
</head>

<body>
	<div class="container-fluid layout">
		<div class="row">
			<nav class="navbar navbar-expand-lg">
				<button class="navbar-toggler navbar-light" type="button" data-toggle="collapse" data-target="#filters">
            		<span class="navbar-toggler-icon"></span>
        		</button>
				<div class="collapse navbar-collapse" id="filters">
					<form>
						<h4>Filtres</h4>
						<table>
							<tr>
								<td>
								<h6>Types de vente</h6>
								<table id="typeVenteFilter">
								<tr>
									<td><input type="radio" value="tout" name="bt"> Tout </td>
									<td><input type="radio" value="achat_imm" name="bt"> Achats immediat </td>
								</tr>
								<tr>
									<td><input type="radio" value="encheres" name="bt"> Encheres </td>
									<td><input type="radio" value="offres" name="bt"> Offres </td>
								</tr>
								</table>
								</td>
							</tr>
							<tr>
								<td id="categorieList">
									<h6>Categories</h6>
									<?php 
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
											echo '<input type="checkbox" id="' . $row["ID"] . '"> ' . $row["Nom"] . ' <br>';
										}
									?>
								</td>
							</tr>
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

						$query = "SELECT * FROM items";
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
							if (!$row["Vendu"])
							{
								echo $row["Nom"] . " $" . $row["Prix"] . " " . $row["Description"];
							}
						}
					?>
			</div>
		</div>
		
	</div>
</body>

</html>