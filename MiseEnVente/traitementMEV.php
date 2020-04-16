<?php
	$ID_Vendeur = ""; //Variable de session
	$Nom = isset($_POST["titre"])?$_POST["titre"]:"";
	$Prix = isset($_POST["prix"])?$_POST["prix"]:"";
	$Prix_Encheres = isset($_POST["prixencheres"])?$_POST["prixencheres"]:"";
	$Description = isset($_POST["editor"])?$_POST["editor"]:"";
	$Categorie = isset($_POST["categories"])?$_POST["categories"]:"";
	$Etat = isset($_POST["etat"])?$_POST["etat"]:"";
	$Marque = isset($_POST["marque"])?$_POST["marque"]:"";
	$Type_de_vente_1 = (isset($_POST["achat_imm"])?"achat_imm":(isset($_POST["encheres"])?"encheres":(isset($_POST["offres"])?"offres":"")));
	$Type_de_vente_2 = (($Type_de_vente_1!="achat_imm")?"":(isset($_POST["encheres"])?"encheres":(isset($_POST["offres"])?"offres":"")));

	$error ="";

	if ($Nom == "")
	{
		$error .= "Il faut sp�cifier le titre de l'annonce. ";
	}
	if ($Type_de_vente_1 == "")
	{
		$error .= "Il faut sp�cifier le type de vente de l'annonce. ";
	}
	if ($Prix == "" &&  $Type_de_vente_1 == "achat_imm")
	{
		$error .= "Il faut sp�cifier le prix de l'objet. ";
	}
	if ($Prix_Encheres == "" &&  $Type_de_vente_1 == "encheres" || $Prix_Encheres == "" &&  $Type_de_vente_2 == "encheres" )
	{
		$error .= "Il faut sp�cifier le prix de d�part des ench�res. ";
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

	foreach ($mediaList as &$media) {
		echo '-> ' . $media . '<br>'; 
	}

	$ID_Medias = "";

	echo $Nom . " " . $Prix . " " . $Prix_Encheres . " " . $Description . " " . $Categorie . " " . $Etat . " " . $Marque . " " . $Type_de_vente_1 . " " . $Type_de_vente_2;
?>