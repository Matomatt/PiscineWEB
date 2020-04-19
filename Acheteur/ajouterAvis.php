<?php
        $note = isset($_POST["note"])?$_POST["note"]:"";
        $avis = isset($_POST["commentaire"])?$_POST["commentaire"]:"";
        $ID_Item = isset($_GET["id1"])?$_GET["id1"]:"";
        $ID_Vendeur = isset($_GET["id2"])?$_GET["id2"]:"";
        $ID_Acheteur = isset($_GET["id3"])?$_GET["id3"]:"";
        
        if ($note == "" || $avis == "" || $ID_Item == "" || $ID_Vendeur == "" || $ID_Acheteur == "" )
            die ('<script> window.location = "../Accueil/index.php"; </script>');

        $conn = new mysqli('localhost','root', '', 'ecebay');
        
        if ($conn->connect_error) { die('<script> alert("Database not found"); history.back(); </script>'); }
        
        $sql = "INSERT INTO `notes` (`Note`, `Commentaire`, `ID_Item`, `ID_Acheteur`,`ID_Vendeur`) VALUES ('".$note."', '".$avis."', '".$ID_Item."', '".$ID_Acheteur."', '".$ID_Vendeur."');";
        /*('" . $_GET["id2"] . "', '" . $_GET["id1"] . "', '" . $Quantite . "');";*/
        
        if ($conn->query($sql) === TRUE) {
            $last_id = $conn->insert_id;
            echo "Avis ajouté ! <br>";
        } else {
            echo '<script> alert("Error: ' . $sql . ' ' . $conn->error . '"); window.location = "../Acheteur/mon_compte.php?page=historique"; </script>';
        }
        
        $conn->close();

        echo '<script> window.location = "../Acheteur/mon_compte.php?page=historique"; </script>';
?>