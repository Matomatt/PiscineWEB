<head>
<script type="text/javascript">
	$(document).ready(function () {
		//adapté de cette réponse sur stackoverflow https://stackoverflow.com/a/14069481/12758551
		document.getElementById("getpp").onchange = function () {
			var reader = new FileReader();
			reader.onload = function (e) {
					document.getElementById("pp").src = e.target.result;
			};
			reader.readAsDataURL(this.files[0]);
		};
	});

	function getFileTypeFromFileReader(filename)
	{
		return filename.substring(filename.indexOf(':')+1, filename.indexOf('/')) || filename;
	}
	</script>
</head>


<div class=" col-lg-6 col-sm-3 col-xs-2 mx-auto" style="float:none;  ">
<table type="table" border=1 frame=void rules=rows>
<form action="modifierPPTraitement.php" method="post" enctype="multipart/form-data">
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
    
    $ID_Acheteur = (isset($_SESSION["UserID"])?$_SESSION["UserID"]:"");
    
    $query = "SELECT * FROM acheteurs WHERE ID=".$ID_Acheteur;
    $result = mysqli_query($db_handle, $query);
    
    if (!$result)
    {
        die('Couldn\'t find table');
    }
    
    $acheteur = $result->fetch_assoc();
    
    $pp = ($acheteur["Photo"]!=""?$acheteur["Photo"]:"user-default.png");
    
    echo '<img class="img-fluid" id="pp" src="../UploadedContent/'.$pp.'" style="max-width: 10em; max-height: 10em;"><br>
          <input type="file" name="getpp" id="getpp" accept="image/png,image/jpeg,image/jpg,image/gif" style="margin-bottom: 2em"><br>';
?>
<br>
<button class="col-lg-6" type="submit">Valider</button>
</form>
</table>
</div>