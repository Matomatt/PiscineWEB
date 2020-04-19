<?php
        $avis = isset($_POST["commentaire"])?$_POST["commentaire"]:"";

        session_start();

        $conn = new mysqli('localhost','root', '', 'ecebay');
        
        if ($conn->connect_error) { die('<script> alert("Database not found"); history.back(); </script>'); }
        
        
        $sql = "INSERT INTO `notes` (`Note`, `Commentaire`, `ID_Item`, `ID_Acheteur`,`ID_Vendeur`) VALUES ('3', '".$_POST["commentaire"]."', '".$_SESSION["vID_Item"]."', '".$_SESSION["UserID"]."', '".$_SESSION["vID_Vendeur"]."');";
        /*('" . $_GET["id2"] . "', '" . $_GET["id1"] . "', '" . $Quantite . "');";*/
        
        if ($conn->query($sql) === TRUE) {
            $last_id = $conn->insert_id;
            echo "Avis ajouté ! <br>";
        } else {
            echo '<script> alert("Error: ' . $sql . ' ' . $conn->error . '"); </script>';
        }
        
        $conn->close();

       
        
?>