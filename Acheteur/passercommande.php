<?php
    $db_handle = mysqli_connect('localhost', 'root', '');
    $db_found = mysqli_select_db($db_handle, 'ecebay');
    
    if (!$db_found) { die('Database not found'); }
    
    session_start();
    /*Pour avoir l'utilisateur connecté*/
    if (!isset($_SESSION['UserType']) || !isset($_SESSION['UserID']))
        die ('<script> window.location = "../CreerCompte/connexion.php"; </script>');
        
    if ($_SESSION['UserType'] != "Acheteur")
        die ('<script> window.location = "../CreerCompte/connexion.php"; </script>');
        
    $ID_Acheteur = $_SESSION["UserID"];
    $ID_Adresse = (isset($_POST["ID_Adresse"])?$_POST["ID_Adresse"]:0);
    $ID_mdp = (isset($_POST["mdp"])?$_POST["mdp"]:0);
    $nbItem = (isset($_POST["nbItems"])?$_POST["nbItems"]:0);
    
    echo $ID_Acheteur . ' ' . $ID_Adresse . ' ' . $ID_mdp . ' ' . $nbItem . '<br>';
    
    
    if ($ID_Adresse == 0 || $ID_mdp == 0)
        die ('<script> window.location = "../Accueil/index.php"; </script>');
    
    for ($i=0; $i<$nbItem; $i++)
    {
        $ID_Item = isset($_POST["ID_Item".$i])?$_POST["ID_Item".$i]:0;
        $ID_Vendeur = isset($_POST["ID_Vendeur".$i])?$_POST["ID_Vendeur".$i]:0;
        $Type_de_vente = isset($_POST["Type_de_vente".$i])?$_POST["Type_de_vente".$i]:"";
        $Quantite = isset($_POST["Quantite".$i])?$_POST["Quantite".$i]:0;
        $QuantiteTotal = isset($_POST["QuantiteTotal".$i])?$_POST["QuantiteTotal".$i]:0;
        $Montant = isset($_POST["Montant".$i])?$_POST["Montant".$i]:0;
        $Prix_livraison = isset($_POST["Prix_livraison".$i])?$_POST["Prix_livraison".$i]:"";
        
        echo $ID_Item . ' ' . $ID_Vendeur . ' ' . $Type_de_vente . ' ' . $Quantite . ' ' . $QuantiteTotal . ' ' . $Montant . ' ' . $Prix_livraison . '<br>';
        
        if ($ID_Item != 0 && $ID_Vendeur != 0 &&  $Type_de_vente != "" && $Quantite != 0 && $QuantiteTotal != 0 && $Montant != 0 && $Prix_livraison != "")
        {
            $query = "INSERT INTO `transactions` (`ID_Item`, `ID_Acheteur`, `ID_Vendeur`, `Moyen_de_paiement`, `ID_MDP`, `Type_de_vente`, `Quantite`, `Montant`, `Prix_livraison`) 
                        VALUES ('$ID_Item', '$ID_Acheteur', '$ID_Vendeur', 'Carte_bancaire', '$ID_mdp', '$Type_de_vente', '$Quantite', '$Montant', '$Prix_livraison');";
            
            echo $query . '<br>';
            $result = mysqli_query($db_handle, $query);
            
            if (!$result)
                die ('<script> alert ("ERREUR : Commande de cet item non passée !")</script>');
            else {
                $query = "UPDATE `items` SET `Quantite` = '".($QuantiteTotal-$Quantite)."', `Vendu` = '".(($QuantiteTotal-$Quantite)<=0?"1":"0")."' WHERE `items`.`ID` = ".$ID_Item.";";
                
                echo $query . '<br>';
                $result = mysqli_query($db_handle, $query);
                
                if (!$result)
                    die ('<script> alert ("ERREUR : Item pas mis à jour !"); </script>');
            }
            
            
        }
    }
    
    //echo '<script> window.location = "../Acheteur/mon_compte.php?page=historique.php"; </script>';
?>