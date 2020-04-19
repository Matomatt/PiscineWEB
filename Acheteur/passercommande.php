<?php
    $db_handle = mysqli_connect('localhost', 'root', '');
    $db_found = mysqli_select_db($db_handle, 'ecebay');
    
    if (!$db_found) { die('Database not found'); }
    
    /*Pour avoir l'utilisateur connecté*/
    if (!isset($_SESSION['UserType']) || !isset($_SESSION['UserID']))
        die ('<script> window.location = "../CreerCompte/connexion.php"; </script>');
        
    if ($_SESSION['UserType'] != "Acheteur")
        die ('<script> window.location = "../CreerCompte/connexion.php"; </script>');
        
    $ID_Acheteur = $_SESSION["UserID"];
    
    $query = "SELECT * FROM paniers WHERE ID_Acheteur=".$ID_Acheteur;
    $result = mysqli_query($db_handle, $query);
    
    if (!$result)
        die ('<script> window.location = "../Accueil/index.php"; </script>');
    
    while($item=$result->fetch_assoc())
    {
        
    }
?>