
<div class="wishlist col-lg-8">
    <h3>Ma wishlist</h3>
    <table>

<!----------------------------------->
        <?php
                $db_handle = mysqli_connect('localhost', 'root', '');
                $db_found = mysqli_select_db($db_handle, 'ecebay');

                if (!$db_found) { die('Database not found'); }

                /*Pour avoir l'utilisateur connecté*/
                if (!isset($_SESSION['UserType']) || !isset($_SESSION['UserID']))
                    echo '<script> window.location = "../CreerCompte/connexion.php"; </script>';
                    
                if ($_SESSION['UserType'] != "Acheteur")
                    echo '<script> window.location = "../CreerCompte/connexion.php"; </script>';
                                        

                /*Pour avoir id de l'acheteur*/
                $ID_Acheteur=(isset($_SESSION["UserID"])?$_SESSION["UserID"]:"");
                $query = "SELECT * FROM items WHERE ID IN (SELECT Id_Item FROM wishlists WHERE ID_Acheteur=".$ID_Acheteur.")";
                $result = mysqli_query($db_handle, $query);

                if (!$result)
                {
                  die('Couldn\'t find table');
                }

                while($row = $result->fetch_assoc()) 
                {   
                    /*on récupère les données de la table medias*/
                    $img = mysqli_query($db_handle, "SELECT File FROM medias WHERE ID_Item=" . $row["ID"] . " AND indx = 0;")->fetch_assoc() ["File"];
                    echo '<tr style="text-align: justify;">
                            <td><img onclick="location.href=\'../Produit/index.php?id=' . $row["ID"] . '\';" style="max-width: 10em; max-height: 10em" src="../UploadedContent/'. (($img!="") ? $img : 'blank.png') . '" ></td>';

                    $PrixArticle = $row["Prix"];
                    if ($row["Type_de_vente_1"] == "encheres")
                        $PrixArticle = $row["Prix_Encheres"];
                    else if ($row["Type_de_vente_1"] == "offres" || $row["Type_de_vente_2"] == "offres")
                    {
                        $offreAccepted = mysqli_query($db_handle,'SELECT Prix FROM offres WHERE ID_Item=' . $row["ID"] .' AND ID_Acheteur=' . $ID_Acheteur .' AND Accepted=1 ORDER BY Date DESC');
                        
                        if (!$offreAccepted)
                            die ("Erreur lors de la requète");
                            
                            if (!empty($offreAccepted))
                            {
                                $prixOffre = $offreAccepted->fetch_assoc()["Prix"];
                                $PrixArticle = ($prixOffre<$PrixArticle?$prixOffre:$PrixArticle);
                            }
                            
                    }
                    else if ($row["Type_de_vente_2"] == "encheres")
                    {
                        if (date('Y-m-d h:i:s', strtotime($row["Date_MEV"]. ' + 7 days')) < date('Y-m-d h:i:s', time()))
                        {
                            $MeilleureEnchere = mysqli_query($db_handle,'SELECT MAX(Prix_Max) as "PrixMax" FROM encheres WHERE ID_Item=' . $row["ID"] .' AND ID_Acheteur=' . $ID_Acheteur);
                            
                            if (!$MeilleureEnchere)
                                die ("Erreur lors de la requète");
                                
                                if (!empty($MeilleureEnchere))
                                {
                                    $MeilleureEnchere = $MeilleureEnchere->fetch_assoc()["PrixMax"];
                                    
                                    if ($MeilleureEnchere["PrixMax"] >= $row["Prix_Encheres"])
                                    {
                                        $PrixArticle = $row["Prix_Encheres"];
                                    }
                                }
                        }
                    }
                        
                    echo '<td style="padding-left: 1em;">
                            <strong>'.$row["Nom"].'</strong><br>
                            Prix : '.$PrixArticle.'€
                        </td>
                        <td>
                            <button style="margin-left: 1em;"><a href="../Produit/supprimerDeWishlists.php?id1='.$row["ID"].'&id2='.$ID_Acheteur.'">Supprimer</a></button>
                        </td>
                   </tr>';
                }
            ?>
        </table>

    </div>

<!--  
</div>
<div class="enchere col-lg-4" >
    <div class="col-lg-2 col-xs-5">
        <h3>Consulté dernièrement</h3>
        <
        <button class="btn btn-primary" onclick="">Modifier un produit</button><br>
    <button class="btn btn-primary" onclick="">Supprimer un produit</button>

    </div>
</div>
-->