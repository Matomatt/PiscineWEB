<?php 
if (isset($_GET["id"]))
    {
        session_start();
        if(isset($_SESSION['UserID']) && isset($_SESSION['UserType']))
        {
            $ID_Acheteur = ($_SESSION['UserType']=="Acheteur")?$_SESSION['UserID']:"";
            if ($ID_Acheteur == "")
                die ('<script> window.location.href= "../Produit/index.php?id=' . $_GET["id"] . '"; </script>');
            
            $Quantite = isset($_GET["qt"])?($_GET["qt"] != ""?$_GET["qt"]:1):1;
            
            $conn = new mysqli('localhost','root', '', 'ecebay');
            
            if ($conn->connect_error) { die('<script> alert("Database not found"); history.back(); </script>'); }
            
            $queryQT = "SELECT Quantite FROM items WHERE ID =" . $_GET["id"];
            $resultQT = mysqli_query($conn, $queryQT);
            if ($resultQT)
            {
                if (($qt = $resultQT->fetch_assoc()["Quantite"]) < $Quantite)
                    $Quantite = $qt;
            }
            if ($Quantite < 1) $Quantite = 1;
            
            $sql = "INSERT INTO `paniers` (`ID_Acheteur`, `ID_Item`, `Quantite`) VALUES ('" . $ID_Acheteur . "', '" . $_GET["id"] . "', '" . $Quantite . "');";
            
            if ($conn->query($sql) === TRUE) {
                $last_id = $conn->insert_id;
                echo "Ajouté au panier ! " . $last_id . " id<br>";
            } else {
                echo '<script> alert("Error: ' . $sql . ' ' . $conn->error . '"); </script>';
            }
            
            $conn->close();
        }
        
        
        echo '<script> window.location.href= "../Produit/index.php?id=' . $_GET["id"] . '"; </script>';
    }
    else 
        echo '<script> window.location.href= "../Accueil/index.php"; </script>';

?>