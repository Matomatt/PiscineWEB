
<?php
    include '../header.php';
?>

<!DOCTYPE html>
<!-- sources :
    w3schools.com/html/html_tables.asp :table rowspan
-->
<html>
    <head >
        <meta charset= "utf-8">
        <meta name= "viewport" content= "width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="style.css">

        <!-- importing bootstrap-->
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

        <title>Panier - ECEbay</title>
    </head>

    <body>           

        <div class="container-fluid">
            <table>
                <tr>
                    <th>Mon panier</th>
                </tr>

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
                    $query = "SELECT * FROM items WHERE ID IN (SELECT Id_Item FROM paniers WHERE ID_Acheteur=".$ID_Acheteur.")";
                    $result = mysqli_query($db_handle, $query);

                    if (!$result)
                    {
                      die('Couldn\'t find table');
                    }

                    $prixTotalArticle=0;
                    $prixTotalArticles=0;
                    $totalfdp = 0;

                    while($row = $result->fetch_assoc()) 
                    {   
                        $queryQT = "SELECT Quantite FROM paniers WHERE Id_Item =" . $row["ID"] . " AND ID_Acheteur=".$ID_Acheteur.";";
                        $resultQT = mysqli_query($db_handle, $queryQT);
                        $Quantite = 1;
                        if ($resultQT)
                            $Quantite = $resultQT->fetch_assoc()["Quantite"];
                        
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
                                $PrixArticle = ($prixOffre!=""?($prixOffre<$PrixArticle?$prixOffre:$PrixArticle):$PrixArticle);
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
                        
                        /*on récupère les données de la table medias*/
                        $img = mysqli_query($db_handle, "SELECT File FROM medias WHERE ID_Item=" . $row["ID"] . " AND indx = 0;")->fetch_assoc() ["File"];
                        echo '<tr>
                                <td style="text-align: center">
                                <img onclick="location.href=\'../Produit/index.php?id=' . $row["ID"] . '\';" style="max-width: 10em; max-height: 10em" src="../UploadedContent/'. (($img!="") ? $img : 'blank.png') . '" ></td>';

                        echo '<td>
                                <strong>'.$row["Nom"].'</strong>
                                <hr>
                                <div style="margin-left: 2em">
                                    Quantité : <form method="post" action="../Acheteur/modifPanier.php?id='.$row["ID"].'"> <input type="number" min="1" max="'.$row["Quantite"].'" value="'.$Quantite.'" name="qt"></input>
                                    <button type="submit" class="btn btn-light" style="font-size: 50%">Modifier</button> </form>
                                </div>
                             </td>
                             <td style="text-align: center;">
                                <div  style="margin-left: 3em;">
                                    Prix : '.$PrixArticle.'€<br>
                                    Frais de port : '.$row["Frais_de_port"].'€<br>
    			                    <button><a href="../Produit/supprimerDuPanier.php?id1='.$row["ID"].'&id2='.$ID_Acheteur.'">Supprimer</a>
                                </div>
                             </td>
                       </tr>'; 

                        $prixTotalArticles += ($PrixArticle*$Quantite);
                        $totalfdp += $row["Frais_de_port"];
                    }

                    echo '</table> <hr> <table><tr>
                            <th rowspan="5"><div style="margin-left: 2em; margin-right: 4em">Prix Total</div></th>
                            <td>'.$prixTotalArticles.'€</td>
                            </tr>
                            <tr>
                                <td>Frais de ports : '.$totalfdp.'€</td>
                         </tr>
                         <tr>
                            <td>Total : '.($prixTotalArticles+$totalfdp).'€</td>
                        </tr>';
                ?>
            </table> 
            <br>      
            <button onclick="location.href='../Accueil/index.php';">Poursuivre mes achats</button>
            <button onclick="location.href='../Acheteur/verificationCommande.php';">Finaliser la commande</button>  
        </div>
    </body>
</html>