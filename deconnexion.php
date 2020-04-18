<?php
    session_start();
    if (isset($_SESSION["UserID"]))
    {
        UNSET($_SESSION["UserID"]);
    }
    if (isset($_SESSION["UserType"]))
    {
        UNSET($_SESSION["UserType"]);
    }
    session_destroy();
    
    die('<script>
    		window.location = "Accueil/index.php";
    	  </script>');
?>