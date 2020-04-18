<?php
    date_default_timezone_set('Europe/Paris');
    // se connecter à la BDD
    $db_handle = mysqli_connect('localhost', 'root', '');
    $db_found = mysqli_select_db($db_handle, 'ecebay');
    
    if (!$db_found)
        die ("Impossible d'accéder à la base de donnée");
    
    $query = "SELECT * FROM items WHERE (Type_de_vente_1 = 'encheres' OR Type_de_vente_2 = 'encheres') AND Vendu=0";
    $result = mysqli_query($db_handle, $query);
    
    if (!$result)
        die ("Erreur lors de la requète");
    
    while($item = $result->fetch_assoc())
    {
        $MeilleureEnchere = mysqli_query($db_handle,'SELECT ID_Acheteur, MAX(Prix_Max) as "PrixMax" FROM encheres WHERE ID_Item=' . $item["ID"] );
        
        if (!$MeilleureEnchere)
            die ("Erreur lors de la requète");
        
        if (mysqli_num_rows($MeilleureEnchere) > 0)
        {
            $MeilleureEnchere = $MeilleureEnchere->fetch_assoc();
            
            $getSurencheresQuery = 'SELECT * FROM encheres WHERE ID_Item=' . $item["ID"]. ' AND ID_Acheteur = ' . $MeilleureEnchere["ID_Acheteur"] . ' AND Prix_Max <> ' . $MeilleureEnchere["PrixMax"] . ';';
            $surenchere = mysqli_query($db_handle, $getSurencheresQuery);
            
            if ($surenchere)
            {
                while ($enchereAsuppr = $surenchere->fetch_assoc())
                {
                    
                    $queryDelete = "DELETE FROM `encheres` WHERE `encheres`.`ID` =" . $enchereAsuppr["ID"] . ";";
                    $resultDelete = mysqli_query($db_handle, $queryDelete);
                    if ($resultDelete)
                        echo "Deleted ! " . $queryDelete . '<br>';
                    else
                        echo "Error deleting... " . $queryDelete . '<br>';
                }
            }
            else
                echo ("Error get surenchere " . $getSurencheresQuery) . '<br>';
            
            if ($MeilleureEnchere["PrixMax"] > $item["Prix_Encheres"])
            {
                $queryUpdate = "UPDATE `items` SET `Prix_Encheres` = '" . $MeilleureEnchere["PrixMax"] . "' WHERE `items`.`ID` = " . $item["ID"] . ";";
                $resultUpdate = mysqli_query($db_handle, $queryUpdate);
                if ($resultUpdate)
                    echo "Updated ! " . $queryUpdate . '<br>';
                else
                    echo "Error updating... " . $queryUpdate . '<br>';
                
                if (date('Y-m-d h:i:s', strtotime($item["Date_MEV"]. ' + 7 days')) < date('Y-m-d h:i:s', time()))
                {
                    $DejaDansLePanier = mysqli_query($db_handle,'SELECT * FROM paniers WHERE ID_Item=' . $item["ID"] . ' AND ID_Acheteur=' . $MeilleureEnchere["ID_Acheteur"]);
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
                                echo 'Dans le panier depuis plus de 24h ! Allez hop on remets aux enchères ! <br>';
                                $queryUpdate = "UPDATE `items` SET `Prix_Encheres` = '" . $item["Prix_depart_encheres"] . "', `Date_MEV` = '" . date('Y-m-d h:i:s', time()) . "' WHERE `items`.`ID` = " . $item["ID"] . ";";
                                $resultUpdate = mysqli_query($db_handle, $queryUpdate);
                                if ($resultUpdate)
                                    echo "Updated ! " . $queryUpdate . '<br>';
                                else
                                    echo "Error updating... " . $queryUpdate . '<br>';
                                
                                echo 'On remets les encheres max de tout le monde a zero <br>';
                                $encheres = mysqli_query($db_handle,'SELECT * FROM encheres WHERE ID_Item=' . $item["ID"]);
                                
                                if ($encheres)
                                {
                                    while ($encheresAupdate = $encheres->fetch_assoc())
                                    {
                                        $queryUpdate = "UPDATE `encheres` SET `Prix_Max` = '0' WHERE `encheres`.`ID` = " . $encheresAupdate["ID"] . ";";
                                        $resultUpdate = mysqli_query($db_handle, $queryUpdate);
                                        if ($resultUpdate)
                                            echo "Updated ! " . $queryUpdate . '<br>';
                                        else
                                            echo "Error updating... " . $queryUpdate . '<br>';
                                    }
                                }
                            }
                            else
                                echo 'Déjà dans le panier, enchère enregistrée ! <br>';
                        }
                    }
                    
                    if ($deja == 0)
                    {
                        $queryPanier = "INSERT INTO `paniers` (`ID_Acheteur`, `ID_Item`, `Quantite`) VALUES ('" . $MeilleureEnchere["ID_Acheteur"] . "', '" . $item["ID"] . "', '1');";
                        $resultAddPanier = mysqli_query($db_handle, $queryPanier);
                        if ($resultAddPanier)
                            echo "Ajouté au panier ! " . $queryPanier . '<br>';
                        else
                            echo "Erreur ajout panier... " . $queryPanier . '<br>';
                    }
                }
            }
        }
    }
    
    
    /*
     $queryEnchere = 'SELECT * FROM encheres WHERE ID_Item=' . $item["ID"];
     $resultEncheres = mysqli_query($db_handle, $queryEnchere);
     
     if (!$resultEncheres)
     die ("Erreur lors de la requète");
     
     $max = $item["Prix_Encheres"];
     $secondMax = $item["Prix_Encheres"];
     while($enchere = $resultEncheres->fetch_assoc())
     {
     if ($enchere["Prix_Max"] > $max)
     {
     $secondMax = $max;
     $max = $enchere["Prix_Max"];
     }
     }*/

?>


