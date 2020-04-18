<?php 
    if (isset($_GET["id1"]) && isset($_GET["id2"]))
    {
        $Quantite = isset($_GET["qt"])?($_GET["qt"] != ""?$_GET["qt"]:1):1;
        
        $conn = new mysqli('localhost','root', '', 'ecebay');
        
        if ($conn->connect_error) { die('<script> alert("Database not found"); history.back(); </script>'); }
        
        $queryQT = "SELECT Quantite FROM items WHERE ID =" . $_GET["id1"];
        $resultQT = mysqli_query($conn, $queryQT);
        if ($resultQT)
        {
            if (($qt = $resultQT->fetch_assoc()["Quantite"]) < $Quantite)
                $Quantite = $qt;
        }
        if ($Quantite < 1) $Quantite = 1;
        
        $sql = "INSERT INTO `paniers` (`ID_Acheteur`, `ID_Item`, `Quantite`) VALUES ('" . $_GET["id2"] . "', '" . $_GET["id1"] . "', '" . $Quantite . "');";
        
        if ($conn->query($sql) === TRUE) {
            $last_id = $conn->insert_id;
            echo "Ajouté au panier ! " . $last_id . " id<br>";
        } else {
            echo '<script> alert("Error: ' . $sql . ' ' . $conn->error . '"); </script>';
        }
        
        $conn->close();
        
        echo '<script> window.location.href= "../Produit/index.php?id=' . $_GET["id1"] . '"; </script>';
    }
    else 
        echo '<script> window.location.href= "../Accueil/index.php"; </script>';

?>