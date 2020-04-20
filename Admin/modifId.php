<?php 
    
    if(isset($_POST["id"]))
    {
        session_start();
        $_SESSION["UserID"] = $_POST["id"];
    }
    echo '<script> window.location = "../Admin/mon_compte.php?page=produits"; </script>';
?>