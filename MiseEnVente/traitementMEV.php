<?php 
    function lesBonsBackslash($string)
    {
        $start = 0;
        while (($i = stripos($string, '"', $start)))
        {
            $string = substr ( $string , 0, $i ) . "\\" . substr( $string, $i);
            $start = $i+2;
        }
        $start = 0;
        while (($i = stripos($string, '\'', $start)) != false)
        {
            $string = substr ( $string , 0, $i ) . "\\" . substr( $string, $i);
            $start = $i+2;
        }
        return $string;
    }
?>

<?php
	$ID_Vendeur = 1; //Variable de session
	$Nom = isset($_POST["titre"])?lesBonsBackslash($_POST["titre"]):"";
	$Prix = isset($_POST["prix"])?$_POST["prix"]:"";
	$Prix_Encheres = isset($_POST["prixencheres"])?$_POST["prixencheres"]:"";
	$Description = isset($_POST["editor"])?lesBonsBackslash($_POST["editor"]):"";
	$Categorie = isset($_POST["categories"])?$_POST["categories"]:"";
	$Etat = isset($_POST["etat"])?$_POST["etat"]:"";
	$Marque = isset($_POST["marque"])?lesBonsBackslash($_POST["marque"]):"";
	$Type_de_vente_1 = (isset($_POST["achat_imm"])?"achat_imm":(isset($_POST["encheres"])?"encheres":(isset($_POST["offres"])?"offres":"")));
	$Type_de_vente_2 = (($Type_de_vente_1!="achat_imm")?"":(isset($_POST["encheres"])?"encheres":(isset($_POST["offres"])?"offres":"")));
	$Quantite = isset($_POST["quantite"])?$_POST["quantite"]:"1";
	if ($Quantite < 1) $Quantite = 1;
	$Type_livraison = isset($_POST["modeenvoi"])?lesBonsBackslash($_POST["modeenvoi"]):"";
	$Frais_de_port = isset($_POST["prixenvoi"])?$_POST["prixenvoi"]:"";

	$error ="";

	if ($Nom == "")
	{
		$error .= "Il faut spécifier le titre de l'annonce. ";
	}
	if ($Type_de_vente_1 == "")
	{
		$error .= "Il faut spécifier le type de vente de l'annonce. ";
	}
	if ($Prix == "" &&  $Type_de_vente_1 == "achat_imm")
	{
		$error .= "Il faut spécifier le prix de l'objet. ";
	}
	if ($Prix_Encheres == "" &&  $Type_de_vente_1 == "encheres" || $Prix_Encheres == "" &&  $Type_de_vente_2 == "encheres" )
	{
		$error .= "Il faut spécifier le prix de départ des enchères. ";
	}

	if ($error != "")
	{
		die ('<script>
				alert("' . $error . '");
				window.location = "../MiseEnVente/index.html";
			  </script>');
	}

	$mediaList = array();
	$errorToPrint = "";
	$maxsize = 100 * 1024 * 1024;
	$totalSize = 0;

	$nbFilesUploaded = 0;
	for($i=0; $i<10; $i++)
	{
		//Adapt� de ce tutoriel https://www.tutorialrepublic.com/php-tutorial/php-file-upload.php
		if(isset($_FILES["media".$i]) && $_FILES["media".$i]["error"] == 0)
		{
			$error = "";
			$allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png", "mp4" => "video/mp4");
			
			// Verify file extension
			$ext = pathinfo($_FILES["media".$i]["name"], PATHINFO_EXTENSION);
			if(!array_key_exists($ext, $allowed)) $error = "Please select a valid file format. ";

			if ($error == "")
			{
				$characters = '0123456789abcdefghijklmnopqrstuvwxyz';
				$charactersLength = strlen($characters);
				$randomString = '';
				do{
					$randomString = '';
					for ($j = 0; $j < 32; $j++) {
						$randomString .= $characters[rand(0, $charactersLength - 1)]; }
				}while(file_exists("../UploadedContent/" . $randomString . "." . $ext));
				
				$filename = $randomString . "." . $ext;
				$filetype = $_FILES["media".$i]["type"];
				$filesize = $_FILES["media".$i]["size"];

				// Verify total file size < 100MB
				$totalSize += $filesize;
				if($totalSize > $maxsize) { $error = "Total file size is larger than the allowed limit."; break; }

				// Verify MYME type of the file
				if(in_array($filetype, $allowed)){
					// Check whether file exists before uploading it
					if(file_exists("../UploadedContent/" . $filename)){
						$error =  $filename . " already exists. ";
					} else{
						move_uploaded_file($_FILES["media".$i]["tmp_name"], "../UploadedContent/" . $filename);
						array_push($mediaList, $filename);
					} 
				} else{
					$error = "There was a problem uploading your file. Please try again."; 
				}
			}

			$errorToPrint .= $error;
		}
		else if (!isset($_FILES["media".$i])) {
			$errorToPrint .= "media $i doesn't exist. ";
		} else {
			$errorToPrint .= 'Error number ' . $_FILES["media".$i]["error"] . '. ';
		}
	}

	if ($errorToPrint != "")
	{
		echo '<script>
				alert("' . $errorToPrint . '");
			  </script>';
	}


	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "ecebay";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die ('<script>
				alert("Impossible d\'accéder à la base de donnée");
				window.location = "../MiseEnVente/index.html";
			  </script>');
	}

	$sql = "INSERT INTO items (ID_Vendeur, Nom, Prix, Prix_Encheres, Prix_depart_encheres, Description, Categorie, Etat, Marque, Type_de_vente_1, Type_de_vente_2, Quantite)
	VALUES ('" . $ID_Vendeur . "', '" . $Nom . "', '" . $Prix . "', '" . $Prix_Encheres . "', '" . $Prix_Encheres . "', '" . $Description .  "', '" . $Categorie .  "', '" . $Etat .  "', '" . $Marque .  "', '" . $Type_de_vente_1 .  "', '" . $Type_de_vente_2 .  "', '" . $Quantite .  "')";

	if ($conn->query($sql) === TRUE) {
		$last_id = $conn->insert_id;
		echo "New record created successfully. Last inserted ID is: " . $last_id . "<br>";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}


	$sql = "INSERT INTO medias (ID_Item, File, indx) VALUES";

	

	for($i = 0; $i < count ($mediaList); $i++)
	{
		$sql .= (($i>0)?", ":" ") . "(" . $last_id . ", '" . $mediaList[$i] . "', " . $i . ")";
	}

	if ($conn->query($sql) === TRUE) {
		echo "Medias succesfully saved ! <br>";
	} else if ($conn->error != 4){
		echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();
	
	echo '<script> window.location.href= "../Vendeur/pagevendeur.html"; </script>';
?>