<?php
    date_default_timezone_set('Europe/Paris');
    // se connecter à la BDD
    $db_handle = mysqli_connect('localhost', 'root', '');
    $db_found = mysqli_select_db($db_handle, 'ecebay');
    
    if (!$db_found)
        die ("Impossible d'accéder à la base de donnée");
    
    $ID_Offre = isset($_POST["ID_Offre"])?$_POST["ID_Offre"]:"";
    if($ID_Offre == "")
        die ("Erreur, pas d'offre spécifiée");
    
    $query = "SELECT * FROM offres WHERE ID =" . $ID_Offre;
    $result = mysqli_query($db_handle, $query);
    
    if (!$result)
        die ("Erreur lors de la requète");
    
    $offre = $result->fetch_assoc();
    
    $DejaDansLePanier = mysqli_query($db_handle,'SELECT * FROM paniers WHERE ID_Item=' . $offre["ID_Item"] . ' AND ID_Acheteur=' . $offre["ID_Acheteur"]);
    $deja = 0;
    
    if ($DejaDansLePanier)
    {
        if (mysqli_num_rows($DejaDansLePanier) > 0)
        {
            $deja = 1;
            $DejaDansLePanier = $DejaDansLePanier->fetch_assoc();
            echo '<br> ' . date('Y-m-d h:i:s', strtotime($DejaDansLePanier["Date"]. ' + 1 days')) . ' < ' . date('Y-m-d h:i:s', time()) . '<br>';
            if (date('Y-m-d h:i:s', strtotime($DejaDansLePanier["Date"]. ' + 1 days')) < date('Y-m-d h:i:s', time()))
            {
                echo 'Dans le panier depuis plus de 24h ! Allez hop on annule l\'offre ! <br>';
                $query = "DELETE FROM offres WHERE ID_Item=" . $offre["ID_Item"] . " AND ID_Acheteur=" . $offre["ID_Acheteur"];
                $result = mysqli_query($db_handle, $query);
                
                if ($resultUpdate)
                    echo "Deleted ! " . $queryUpdate . '<br>';
                else
                    echo "Error deleting... " . $queryUpdate . '<br>';
            }
            else
                echo 'Déjà dans le panier, enchère enregistrée ! <br>';
        }
    }
    
    if ($deja == 0 && $offre["ID"] != "")
    {
        $queryPanier = "INSERT INTO `paniers` (`ID_Acheteur`, `ID_Item`, `Quantite`) VALUES ('" . $offre["ID_Acheteur"] . "', '" . $offre["ID_Item"] . "', '1');";
        $resultAddPanier = mysqli_query($db_handle, $queryPanier);
        if ($resultAddPanier)
            echo "Ajouté au panier ! " . $queryPanier . '<br>';
        else
            echo "Erreur ajout panier... " . $queryPanier . '<br>';
    }
?>


