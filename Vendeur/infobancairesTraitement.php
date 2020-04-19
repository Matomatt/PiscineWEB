<?php
session_start();
        //Récupérer les données venant de creerboutique.html
    $emailPaypal = isset($_POST["emailPaypal"])? $_POST["emailPaypal"] : "";
    $mdpPaypal = isset($_POST["mdpPaypal"])? $_POST["mdpPaypal"] : "";
    $nomCarte = isset($_POST["nomCarte"])? $_POST["nomCarte"] : "";
    $numeroCarte = isset($_POST["numeroCarte"])? $_POST["numeroCarte"] : "";
    $dateCarte = isset($_POST["dateCarte"])? $_POST["dateCarte"] : "";
    $cryptoCarte =isset($_POST["cryptoCarte"])? $_POST["cryptoCarte"] : "";

    
    //identifier la BDD
    $database = "ecebay";

    // se connecter à la BDD
    $db_handle = mysqli_connect('localhost', 'root', '');
    $db_found = mysqli_select_db($db_handle, $database);
    

    $id=(isset($_SESSION["UserID"])?$_SESSION["UserID"]:"");
    $user=(isset($_SESSION["UserType"])?$_SESSION["UserType"]:"");

   
    if(!empty($_POST['ajoutercarte']))
    { 
        if( !empty($_POST["nomCarte"]) && !empty($_POST['numeroCarte']) && !empty($_POST["dateCarte"]) && !empty($_POST['cryptoCarte']))
        {
            $sql= "INSERT INTO carte_bancaires (ID_Acheteur, Nom, Numero, Date_Expiration, Code)
                VALUES ('$id','$nomCarte', '$numeroCarte','$dateCarte','$cryptoCarte')";

            $result = mysqli_query($db_handle, $sql); 

            if($result)
            {
                echo "okay";
            }
            else
            {
                echo " La carte n'a pas été enregistrée.";
                echo "Erreur: " . $sql . "<br>" . mysqli_error($db_handle);
            }

        }
        else
        {
            die('<script>
               alert("Veuillez remplir tout les champs");
               window.location = "../Acheteur/infobancaires.php";
               </script>') ;
        }
    }


    if(!empty($_POST['addpaypal']))
    {
        
        if( !empty($_POST["emailPaypal"]) && !empty($_POST['mdpPaypal']))
        {
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
            window.location = "../Acheteur/infobancaires.php";
            </script>') ;
        }
    }

    ?>