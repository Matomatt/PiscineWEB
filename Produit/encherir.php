<?php 
    if (isset($_GET["id1"]) && isset($_GET["id2"]))
    {
        $enchere = isset($_POST["enchere"])?($_POST["enchere"] != ""?$_POST["enchere"]:0):0;
        
        $conn = new mysqli('localhost','root', '', 'ecebay');
        
        if ($conn->connect_error) { die('<script> alert("Database not found"); history.back(); </script>'); }

        $getSurencheresQuery = 'SELECT * FROM encheres WHERE ID_Item=' . $_GET["id1"] . ' AND ID_Acheteur = ' . $_GET["id2"] . ';';
        $getSurencheres = $conn->query($getSurencheresQuery);
        if ($getSurencheres)
        {
            while ($ench = $getSurencheres->fetch_assoc())
            {
                $queryDelete = "DELETE FROM `encheres` WHERE `encheres`.`ID` =" . $ench["ID"] . ";";
                $resultDelete = $conn->query($queryDelete);
                if (!$resultDelete)
                    echo "Error deleting... " . $queryDelete . '<br>';
            }
        }
        
        $sql = "INSERT INTO `encheres` (`ID_Acheteur`, `ID_Item`, `Prix_Max`) VALUES ('" . $_GET["id2"] . "', '" . $_GET["id1"] . "', '" . $enchere . "');";
        
        if ($conn->query($sql) === TRUE) {
            $last_id = $conn->insert_id;
            echo "Ajouté aux encheres ! " . $last_id . " id<br>";
        } else {
            echo '<script> alert("Error: ' . $sql . ' ' . $conn->error . '"); </script>';
        }
        
        $conn->close();
        include '../processEncheres.php';
        echo '<script> window.location.href= "../Acheteur/mon_compte.php?page=encheres"; </script>';
    }
    else
        echo '<script> window.location.href= "../Accueil/index.php"; </script>';
?>