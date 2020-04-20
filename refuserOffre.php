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
        
        $sql = "DELETE FROM offres WHERE ID_Item=" . $offre["ID_Item"] . " AND ID_Acheteur=" . $offre["ID_Acheteur"];
        
        if (!$conn->query($sql))
            echo 'Nothing has been deleted.<br>';
        
        $conn->close();
        echo '<script> window.location.href= "'.$_SESSION["UserType"].'/mon_compte.php?page=offres"; </script>';
    }
    else
        echo '<script> alert("Erreur"); window.location.href= "Accueil/index.php"; </script>';
?>

