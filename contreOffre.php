<?php 
    if (isset($_GET["id"]))
    {
        session_start();
        if (!isset($_SESSION["UserID"]) || !isset($_SESSION["UserType"]))
        {
            die('<script>
                    alert("Veuillez vous connecter à votre compte");
                    window.location = "CreerCompte/connexion.php";
                </script>');
        }
        
        $UID = (isset($_SESSION["UserID"])?$_SESSION["UserID"]:"");
        
        $conn = new mysqli('localhost','root', '', 'ecebay');
        
        if ($conn->connect_error) { die('<script> alert("Database not found"); history.back(); </script>'); }
        
        $sql = "SELECT * FROM offres WHERE ID=" . $_GET["id"];
        
        if (!($offre=$conn->query($sql)))
            echo '<script> alert("Error: ' . $sql . ' ' . $conn->error . '"); </script>';
            
        $offre = $offre->fetch_assoc();
        
        if ($_SESSION["UserType"] == $offre["Instigateur"])
        {
            die('<script>
            alert("Veuillez vous connecter au bon compte");
            window.location = "CreerCompte/connexion.php";
        </script>');
        }
    
        if ($_SESSION["UserType"] == "Acheteur")
        {
            if ($offre["Iteration_number"] >= 5)
                die( '<script> alert("Vous avez déjà envoyé 5 offres sur cet item"); window.location.href= "Acheteur/mon_compte.php?page=offres"; </script>');
        }
        
        $prix = isset($_POST["contreoffre"])?$_POST["contreoffre"]:$offre["Prix"]+1;
        $sql = "INSERT INTO `offres` (`ID_Item`, `ID_Acheteur`, `Instigateur`, `Prix`, `Iteration_number`) VALUES ('" . $offre["ID_Item"] . "', '" . $offre["ID_Acheteur"] . "', '".$_SESSION["UserType"]."', '" . $prix . "', '".($offre["Iteration_number"]+1)."')";
        
        if ($conn->query($sql) === TRUE) {
            $last_id = $conn->insert_id;
            
            $sql = "DELETE FROM offres WHERE ID_Item=" . $offre["ID_Item"] . " AND ID_Acheteur=" . $offre["ID_Acheteur"] . " AND ID <> " . $last_id;
            
            if (!$conn->query($sql))
                echo 'Nothing has been deleted.<br>';
            
            echo "Ajouté aux offres ! " . $last_id . " id<br>";
        } else {
            echo '<script> alert("Error: ' . $sql . ' ' . $conn->error . '"); </script>';
        }
        
        $conn->close();
        //echo '<script> window.location.href= "'.$_SESSION["UserType"].'/mon_compte.php?page=offres"; </script>';
    }
    else
        echo '<script> alert("Erreur"); window.location.href= "Accueil/index.php"; </script>';
?>

