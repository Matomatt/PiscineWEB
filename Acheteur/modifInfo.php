<?php
    //Récupérer les données venant de modifierDeb.php

    $prenom = isset($_POST["prenom"])? $_POST["prenom"] : "";
    $nom = isset($_POST["nom"])? $_POST["nom"] : "";
    $tel = isset($_POST["tel"])? $_POST["tel"] : "";
    $email= isset($_POST["email"])? $_POST["email"] : "";
    $ad1 = isset($_POST["adresse"])? $_POST["adresse"] : "";
    $ad2 = isset($_POST["cpadresse"])? $_POST["cpadresse"] : "";
    $ville = isset($_POST["ville"])? $_POST["ville"] : "";
    $cp = isset($_POST["cp"])? $_POST["cp"] : "";
    $pays = isset($_POST["pays"])? $_POST["pays"] : "";

session_start();

   



    $db_handle = mysqli_connect('localhost', 'root', '');
      $db_found = mysqli_select_db($db_handle, 'ecebay');

                    if (!$db_found) { die('Database not found'); }

                    /*if (!isset($_SESSION['UserType']) || !isset($_SESSION['UserID']))
                        echo '<script> window.location = "../CreerCompte/connexion.php"; </script>';
                        
                    if ($_SESSION['UserType'] != "Acheteur")
                        echo '<script> window.location = "../CreerCompte/connexion.php"; </script>';
                                            
*/

                    /*Pour avoir id de l'acheteur*/
                    $ID_Acheteur=$_SESSION["UserID"];



    //si le bouton a été sollicité sur la page HTML
    if(!empty($_POST['bouton1']))
    {
        //Si tout les champs sont remplis
        if(!empty($_POST["prenom"]) && !empty($_POST['nom']) && !empty($_POST['tel']) 
        && !empty($_POST['adresse']) && !empty($_POST['ville']) && !empty($_POST['cp']) && !empty($_POST['pays']))
        {        
   
/* requête acheteur*/
            $query="SELECT * FROM acheteurs WHERE ID=".$ID_Acheteur.";" ;
        
            $result = mysqli_query($db_handle, $query);

            if (!$result)
            {
                die('Couldn\'t find table 1');
            }

            $row = $result->fetch_assoc();

            $sqlupdate = "UPDATE acheteurs SET Nom = '$nom',Prenom = '$prenom', Telephone = '$tel', Email='$email'";

            $result = mysqli_query($db_handle, $sqlupdate);

            if (!$result)
            {
                die('Couldn\'t update');
            }
/*requête adresse*/
            $query="SELECT * FROM adresses WHERE ID=".$row["ID_Adresse"].";" ;
        
            $result = mysqli_query($db_handle, $query);

            if (!$result)
            {
                die('Couldn\'t find table 2');
            }

            $sqlupdate = "UPDATE adresses SET Nom = '$nom', Telephone = '$tel', Adresse_ligne_1 = '$ad1', Adresse_ligne_2 = '$ad2', Ville = '$ville', Pays = '$pays', Code_postale = '$cp'";

            $result = mysqli_query($db_handle, $sqlupdate);

            if (!$result)
            {
                die('Couldn\'t update');
            }

            echo '<script> alert("Modifications effectuées"); </script>';

            echo '<script> window.location.href= "../Acheteur/mon_compte.php"; </script>';
        }
    }

?>