<?php 
if (isset($_GET["id"]))
    {
        session_start();
        if(isset($_SESSION['UserID']) && isset($_SESSION['UserType']))
        {
            $ID_Acheteur = ($_SESSION['UserType']=="Acheteur")?$_SESSION['UserID']:"";
            if ($ID_Acheteur == "")
                die ('<script> window.location.href= "../Produit/index.php?id=' . $_GET["id"] . '"; </script>');
            
            $conn = new mysqli('localhost','root', '', 'ecebay');
            
            if ($conn->connect_error) { die('<script> alert("Database not found"); history.back(); </script>'); }
            
            //$sql = "SELECT * FROM wishlists (`ID_Acheteur`, `ID_Item`) VALUES ('" . $ID_Acheteur . "', '" . $_GET["id"] . "');";
            
            $sql = "INSERT INTO `wishlists` (`ID_Acheteur`, `ID_Item`) VALUES ('" . $ID_Acheteur . "', '" . $_GET["id"] . "');";
            
            if ($conn->query($sql) === TRUE) {
                $last_id = $conn->insert_id;
                echo "Ajouté a la wishlist ! " . $last_id . " id<br>";
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