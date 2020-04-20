<?php
        //Récupérer les données venant de creerboutique.html
    $emailPaypal = isset($_POST["emailPaypal"])? $_POST["emailPaypal"] : "";
    $mdpPaypal = isset($_POST["mdpPaypal"])? $_POST["mdpPaypal"] : "";
    
    //identifier la BDD
    $database = "ecebay";

    // se connecter à la BDD
    $db_handle = mysqli_connect('localhost', 'root', '');
    $db_found = mysqli_select_db($db_handle, $database);
    
    session_start();
    $id=(isset($_SESSION['UserID'])?$_SESSION['UserID']:"");
    $user=(isset($_SESSION['UserType'])?$_SESSION['UserType']:"");
    
    if ($id=="")
        die ('<script> alert("Veuillez vous connecter"); window.location = "../CreerCompte/connexion.php"; </script>');

        
    if( isset($_POST["emailPaypal"]) && isset($_POST['mdpPaypal']))
    {
        if ($_POST["emailPaypal"]=="" || $_POST['mdpPaypal']=="")
            die('<script> alert("Veuillez remplir tout les champs"); window.location = "../'.$user.'/mon_compte.php?page=infobancaires"; </script>') ;
        $sql= "INSERT INTO paypal_accounts (ID_Proprietaire, Type_proprietaire, Email, Montant)
        VALUES ('$id','$user', '$emailPaypal','100')";
        $result = mysqli_query($db_handle, $sql);   
        if($result)
        {
            echo "okay";

        }
        else
        {
            echo " Le compte n'a pas été enregistré";
        }
    }
    else
    {
        die('<script>
        alert("Veuillez remplir tout les champs");
        window.location = "../'.$user.'/mon_compte.php?page=infobancaires";
        </script>') ;
    }
    
    echo '<script> window.location = "../'.$user.'/mon_compte.php?page=infobancaires"; </script>';

    ?>