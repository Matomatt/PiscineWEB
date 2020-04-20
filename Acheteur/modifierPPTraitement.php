<?php
    session_start();
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
    
    $id=(isset($_SESSION["UserID"])?$_SESSION["UserID"]:"");
    
	$error ="";
	
	$pp="";
	$errorToPrint = "";
	$maxsize = 100 * 1024 * 1024;
	$totalSize = 0;

	$nbFilesUploaded = 0;
		//Adapt� de ce tutoriel https://www.tutorialrepublic.com/php-tutorial/php-file-upload.php
	if(isset($_FILES["getpp"]) && $_FILES["getpp"]["error"] == 0)
	{
		$error = "";
		$allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png", "mp4" => "video/mp4");
		
		// Verify file extension
		$ext = pathinfo($_FILES["getpp"]["name"], PATHINFO_EXTENSION);
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
			$filetype = $_FILES["getpp"]["type"];
			$filesize = $_FILES["getpp"]["size"];

			// Verify total file size < 100MB
			$totalSize += $filesize;
			if($totalSize > $maxsize) { $error = "Total file size is larger than the allowed limit.";}

			if ($error=="")
			{
			    // Verify MYME type of the file
			    if(in_array($filetype, $allowed)){
			        // Check whether file exists before uploading it
			        if(file_exists("../UploadedContent/" . $filename)){
			            $error =  $filename . " already exists. ";
			        } else{
			            move_uploaded_file($_FILES["getpp"]["tmp_name"], "../UploadedContent/" . $filename);
			            $pp = $filename;
			        }
			    } else{
			        $error = "There was a problem uploading your file. Please try again.";
			    }
			}
		}

		$errorToPrint .= $error;
	}
	else if (!isset($_FILES["getpp"])) {
		$errorToPrint .= "getpp doesn't exist. ";
	} else if ($_FILES["getpp"]["error"] != 4){
	    $errorToPrint .= 'Error number ' . $_FILES["getpp"]["error"] . '. ';
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

	if ($pp=="")
	    die ('<script> alert("Veuillez choisir un fichier correct"); window.location.href= "../Acheteur/mon_compte.php?page=modifierPP"; </script>');

	$sql = "UPDATE `acheteurs` SET `Photo` = '".$pp."' WHERE `acheteurs`.`ID` = ".$id.";";
	
	if ($conn->query($sql) === TRUE) {
		echo "Profile succesfully updated ! <br>";
	} else if ($conn->error != 4){
		echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();
	
	echo '<script> window.location.href= "../Acheteur/mon_compte.php"; </script>';
?>