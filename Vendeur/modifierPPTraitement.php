<?php
    session_start();
    if (!isset($_SESSION["UserID"]) || !isset($_SESSION["UserType"]))
    {
        die('<script>
                    alert("Veuillez vous connecter à votre compte");
                    window.location = "../CreerCompte/connexion.php";
                </script>');
    }
    
    if ($_SESSION["UserType"] != "Vendeur")
    {
        die('<script>
                    alert("Veuillez vous connecter à votre compte Vendeur");
                    window.location = "../CreerCompte/connexion.php";
                </script>');
    }
    
    $id=(isset($_SESSION["UserID"])?$_SESSION["UserID"]:"");
    
	$error ="";
	
	$pp=""; $bg="";
	$errorToPrint = "";
	$maxsize = 100 * 1024 * 1024;
	$totalSize = 0;

	$nbFilesUploaded = 0;
	for($i=0; $i<2; $i++)
	{
	    $img=($i==0?"getpp":"getbg");
		//Adapt� de ce tutoriel https://www.tutorialrepublic.com/php-tutorial/php-file-upload.php
	    if(isset($_FILES[$img]) && $_FILES[$img]["error"] == 0)
		{
			$error = "";
			$allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png", "mp4" => "video/mp4");
			
			// Verify file extension
			$ext = pathinfo($_FILES[$img]["name"], PATHINFO_EXTENSION);
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
				$filetype = $_FILES[$img]["type"];
				$filesize = $_FILES[$img]["size"];

				// Verify total file size < 100MB
				$totalSize += $filesize;
				if($totalSize > $maxsize) { $error = "Total file size is larger than the allowed limit."; break; }

				// Verify MYME type of the file
				if(in_array($filetype, $allowed)){
					// Check whether file exists before uploading it
					if(file_exists("../UploadedContent/" . $filename)){
						$error =  $filename . " already exists. ";
					} else{
					    move_uploaded_file($_FILES[$img]["tmp_name"], "../UploadedContent/" . $filename);
						if ($img=="getpp")
						    $pp = $filename;
						else
						    $bg = $filename;
					} 
				} else{
					$error = "There was a problem uploading your file. Please try again."; 
				}
			}

			$errorToPrint .= $error;
		}
		else if (!isset($_FILES[$img])) {
			$errorToPrint .= "$img doesn't exist. ";
		} else if ($_FILES[$img]["error"] != 4){
		    $errorToPrint .= 'Error number ' . $_FILES[$img]["error"] . '. ';
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

	if ($pp=="" && $bg=="")
	    die ('<script> alert("Veuillez choisir des fichiers corrects"); window.location.href= "../Vendeur/mon_compte.php?page=modifierPP"; </script>');

	$sql = "UPDATE `vendeurs` SET ". ($pp!=""?"`PP` = '".$pp."'":"") . ($pp!=""&&$bg!=""?", ":"") . ($bg!=""? "`BG` = '".$bg."'":"") ." WHERE `vendeurs`.`ID` = ".$id.";";
	
	if ($conn->query($sql) === TRUE) {
		echo "Profile succesfully updated ! <br>";
	} else if ($conn->error != 4){
		echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();
	
	echo '<script> window.location.href= "../Vendeur/boutique.php?id='.$id.'"; </script>';
?>