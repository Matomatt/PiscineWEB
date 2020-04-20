<?php
    session_start();
    $ID_Vendeur = isset($_SESSION["UserID"]) && isset($_SESSION["UserType"])?($_SESSION["UserType"] == "Vendeur"?$_SESSION["UserID"]:""):"";
    if ($ID_Vendeur=="")
        die ('<script> window.location = "../Accueil/index.php"; </script>');
    
    $id = isset($_GET["id"])?$_GET["id"]:"";
    
    $db_handle = mysqli_connect('localhost', 'root', '');
    $db_found = mysqli_select_db($db_handle, 'ecebay');
    
    if (!$db_found) { die('<script> alert("Database not found"); window.location = "../Accueil/index.php"; </script>'); }
    
    echo '<script> alert("Fonctionnalité pas encore implémentée"); window.location = "../Accueil/index.php"; </script>';
?>