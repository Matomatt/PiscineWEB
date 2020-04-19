<?php 
    if (isset($_GET["id1"]) && isset($_GET["id2"]))
    {
        $enchere = isset($_POST["enchere"])?($_POST["enchere"] != ""?$_POST["enchere"]:0):0;
        
        $conn = new mysqli('localhost','root', '', 'ecebay');
        
        if ($conn->connect_error) { die('<script> alert("Database not found"); history.back(); </script>'); }

        $sql = "INSERT INTO `encheres` (`ID_Acheteur`, `ID_Item`, `Prix_Max`) VALUES ('" . $_GET["id2"] . "', '" . $_GET["id1"] . "', '" . $enchere . "');";
        
        if ($conn->query($sql) === TRUE) {
            $last_id = $conn->insert_id;
            echo "Ajouté aux encheres ! " . $last_id . " id<br>";
        } else {
            echo '<script> alert("Error: ' . $sql . ' ' . $conn->error . '"); </script>';
        }
        
        $conn->close();
        include '../processEncheres.php';
        echo '<script> window.location.href= "../Acheteur/encheres.php"; </script>';
    }
    else
        echo '<script> window.location.href= "../Accueil/index.php"; </script>';
?>