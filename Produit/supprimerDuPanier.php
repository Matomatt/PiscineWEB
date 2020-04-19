<?php

	if (isset($_GET["id1"]) && isset($_GET["id2"]))
    {        
        $conn = new mysqli('localhost','root', '', 'ecebay');
        
        if ($conn->connect_error) { die('<script> alert("Database not found"); history.back(); </script>'); }
        
        $queryS = "DELETE FROM paniers WHERE ID=".$_GET["id1"]." AND ID_Acheteur=".$_GET["id2"];
		$resultS = mysqli_query($conn, $queryS);

       
       if ($conn->resultS === TRUE) {
            echo "Ajouté au panier !<br>";
        } 
        else {
            echo '<script> alert("Error: ' . $sql . ' ' . $conn->error . '"); </script>';
        }
        
        $conn->close();
        
        echo '<script> window.location.href= "../Acheteur/panier.php?id=' . $_GET["id1"] . '"; </script>';
    }   
?>