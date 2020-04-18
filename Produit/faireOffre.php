<?php 
    if (isset($_GET["id1"]) && isset($_GET["id2"]))
    {
        $offre = isset($_POST["offre"])?($_POST["offre"] != ""?$_POST["offre"]:0):0;
        
        $conn = new mysqli('localhost','root', '', 'ecebay');
        
        if ($conn->connect_error) { die('<script> alert("Database not found"); history.back(); </script>'); }
        
        $sql = "SELECT * FROM offres WHERE ID_Instigateur=" . $_GET["id2"] . " AND ID_Item=" . $_GET["id1"] . " AND Instigateur='Acheteur';";
        
        if (($result=$conn->query($sql)) == TRUE)
        {
            echo '<script> alert("' . $result->num_rows . '"); </script>';
            if ($result->num_rows >= 5)
                die( '<script> alert("Vous avez déjà envoyé 5 offres sur cet item"); window.location.href= "../Acheteur/offres.php"; </script>');
        }
        else
            echo '<script> alert("Error: ' . $sql . ' ' . $conn->error . '"); </script>';
            
        $sql = "INSERT INTO `offres` (`ID_Item`, `ID_Instigateur`, `Instigateur`, `Prix`) VALUES ('" . $_GET["id1"] . "', '" . $_GET["id2"] . "', 'Acheteur', '" . $offre . "')";
        
        if ($conn->query($sql) === TRUE) {
            $last_id = $conn->insert_id;
            echo "Ajouté aux offres ! " . $last_id . " id<br>";
        } else {
            echo '<script> alert("Error: ' . $sql . ' ' . $conn->error . '"); </script>';
        }
        
        $conn->close();
        echo '<script> window.location.href= "../Acheteur/offres.php"; </script>';
    }
    else
        echo '<script> alert("Erreur"); window.location.href= "../Accueil/index.php"; </script>';
?>

