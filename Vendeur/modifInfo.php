<?php
    //Récupérer les données venant de modifDebInfo.php

    $prenom = isset($_POST["prenom"])? $_POST["prenom"] : "";
    $nom = isset($_POST["nom"])? $_POST["nom"] : "";
    $tel = isset($_POST["tel"])? $_POST["tel"] : "";
    $email= isset($_POST["email"])? $_POST["email"] : "";

    session_start();

    $db_handle = mysqli_connect('localhost', 'root', '');
    $db_found = mysqli_select_db($db_handle, 'ecebay');

    if (!$db_found) { die('Database not found'); }

    /*Pour avoir id du vendeur*/
    $ID_Vendeur=(isset($_SESSION["UserID"])?$_SESSION["UserID"]:"");

    //si le bouton a été sollicité
    if(!empty($_POST['bouton1']))
    {
        echo 'bonjour2';
        //Si tout les champs sont remplis
        if(!empty($_POST["prenom"]) && !empty($_POST['nom']) && !empty($_POST['tel']) 
        && !empty($_POST['mail']))
            
        {        
            
   
/* requête vendeur*/
            $query="SELECT * FROM vendeurs WHERE ID=".$ID_Vendeur.";" ;
        
            $result = mysqli_query($db_handle, $query);

            if (!$result)
            {
                die('Couldn\'t find table ');
            }

            $row = $result->fetch_assoc();

            $sqlupdate = "UPDATE vendeurs SET Nom = '$nom',Prenom = '$prenom', Telephone = '$tel', Email='$email'";

            $result = mysqli_query($db_handle, $sqlupdate);

            if (!$result)
            {
                die('Couldn\'t update');
            }

            echo '<script> alert("Modifications effectuées"); </script>';

            echo '<script> window.location.href= "../Vendeur/mon_compte.php"; </script>';
        }
    }

?>