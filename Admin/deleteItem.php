<?php
    session_start();
    $ID = isset($_SESSION["UserID"]) && isset($_SESSION["UserType"])?($_SESSION["UserType"] == "Admin"?$_SESSION["UserID"]:""):"";
    if ($ID=="")
        die ('<script> window.location = "../Accueil/index.php"; </script>');
    
    $id = isset($_GET["id"])?$_GET["id"]:"";
    
    $db_handle = mysqli_connect('localhost', 'root', '');
    $db_found = mysqli_select_db($db_handle, 'ecebay');
    
    if (!$db_found) { die('<script> alert("Database not found"); window.location = "../Accueil/index.php"; </script>'); }
    
    $result = mysqli_query($db_handle, "DELETE FROM items WHERE ID=" . $id . ";");
    
    if (!$result)
        die ('<script> alert("Erreur lors de la suppression"); window.location = "../Accueil/index.php"; </script>');
    
    echo '<script> window.location = "../Admin/mon_compte.php?page=produits"; </script>';
?>