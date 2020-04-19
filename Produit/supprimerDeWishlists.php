<?php

	if (isset($_GET["id1"]) && isset($_GET["id2"]))
    {        
        $conn = new mysqli('localhost','root', '', 'ecebay');
        
        if ($conn->connect_error) { die('<script> alert("Database not found"); history.back(); </script>'); }
        
        $queryS = "DELETE FROM wishlists WHERE ID_Item=".$_GET["id1"]." AND ID_Acheteur=".$_GET["id2"];
		$resultS = mysqli_query($conn, $queryS);

       
		if ($resultS === TRUE) {
            echo "Supprimé de la wishlist !<br>";
        } 
        else {
            echo '<script> alert("Error: ' . $queryS . ' ' . $conn->error . '"); </script>';
        }
        
        $conn->close();
        
        echo '<script> window.location.href= "../Acheteur/mon_compte.php?id=' . $_GET["id1"] . '"; </script>';
    }   
?>