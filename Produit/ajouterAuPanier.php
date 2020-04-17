<?php 
    if (isset($_GET["id1"]) && isset($_GET["id2"]))
    {
        $qt = isset($_GET["qt"])?($_GET["qt"] != ""?$_GET["qt"]:1):1;
        
        $conn = new mysqli('localhost','root', '', 'ecebay');
        
        if ($conn->connect_error) { die('<script> alert("Database not found"); history.back(); </script>'); }
        
        $sql = "INSERT INTO `paniers` (`ID_Acheteur`, `ID_Item`, `Quantite`) VALUES ('" . $_GET["id2"] . "', '" . $_GET["id1"] . "', '" . $qt . "');";
        
        if ($conn->query($sql) === TRUE) {
            $last_id = $conn->insert_id;
            echo "Ajouté au panier ! " . $last_id . " id<br>";
        } else {
            echo '<script> alert("Error: ' . $sql . ' ' . $conn->error . '"); </script>';
        }
        
        $conn->close();
    }
    if (isset($_GET["id1"]))
        echo '<script> window.location.href= "../Produit/index.php?id=' . $_GET["id1"] . '"; </script>';
    else 
        echo '<script> window.location.href= "../Accueil/index.php"; </script>';

?>