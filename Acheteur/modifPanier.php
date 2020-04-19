<?php
    session_start();
    if (isset($_POST["qt"]) && isset($_GET["id"]) && isset($_SESSION['UserID']) && isset($_SESSION['UserType']))
    {
        $ID_Acheteur=($_SESSION['UserType']=="Acheteur"?$_SESSION["UserID"]:"");
        if ($ID_Acheteur == "")
            die('<script> window.location.href= "../Accueil/index.php"; </script>');
        
        $Quantite = ($_POST["qt"] != ""?$_POST["qt"]:1);
        
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
        $sql = "UPDATE `paniers` SET `Quantite` = '".$Quantite."' WHERE `paniers`.`ID_Item` = ".$_GET["id"]." AND `paniers`.`ID_Acheteur` =".$ID_Acheteur.";";
        
        if ($conn->query($sql) === TRUE) {
            echo "Quantité modifié ! <br>";
        } else {
            echo '<script> alert("Error: ' . $sql . ' ' . $conn->error . '"); </script>';
        }
        
        $conn->close();
        
        echo '<script> window.location.href= "../Acheteur/panier.php"; </script>';
    }
    else
        echo '<script> window.location.href= "../Accueil/index.php"; </script>';
    
    ?>