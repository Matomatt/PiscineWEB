
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

        <title>Panier ECEbay</title>

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
                    if (!isset($_SESSION["UserID"]) || !isset($_SESSION["UserType"]))
                    {
                        die('<script>
                                alert("Veuillez vous connecter à votre compte");
                                window.location = "../CreerCompte/connexion.php";
                             </script>');
                    }
                    if ($_SESSION["UserType"] != "Acheteur")
                    {
                        die('<script>
                                alert("Veuillez vous connecter à votre compte Acheteur");
                                window.location = "../CreerCompte/connexion.php";
                             </script>');
                    }
                                            

                    /*Pour avoir id de l'acheteur*/
                    $id=(isset($_SESSION["UserID"])?$_SESSION["UserID"]:"");
                    $query = "SELECT * FROM items WHERE ID IN (SELECT Id_Item FROM paniers WHERE ID_Acheteur=".$id.")";
                    $result = mysqli_query($db_handle, $query);

                    if (!$result)
                    {
                      die('Couldn\'t find table');
                    }

                    $prixTotalArticle=0;

                    $prixTotalArticles=0;

                    $idItem=0;

                    $item=0;

                    while($row = $result->fetch_assoc()) 
                    {   
                        /*on récupère les données de la table medias*/
                        $img = mysqli_query($db_handle, "SELECT File FROM medias WHERE ID_Item=" . $row["ID"] . " AND indx = 0;")->fetch_assoc() ["File"];
                        echo '<tr>
                                <td><img style="width:100px;" src="../UploadedContent/'. (($img!="") ? $img : 'blank.png') . '" ></td>';

                        echo '<td>
                                <p class="nomproduit"><strong>Nom produit : </strong>'.$row["Nom"].'</p>
                                <p class="description">Description Produit : '.$row["Description"].'</p>
                            </td>
                            <td><p class="prix">Prix Unitaire : '.$row["Prix"].'€</p></td>
                            <td><p class="quantite">Quantité : '.$row["Quantite"].'</p></td>
                            <td><p class="prix">Prix : '.($prixTotalArticle=$row["Prix"]*$row["Quantite"]).'€</p></td>
                            <td><button><a href="../Produit/supprimerDuPanier.php?idItem='.$item["ID"].'">Supprimer</button></td> 
                        </tr>'; 

                        $prixTotalArticles=$prixTotalArticles+$prixTotalArticle;  
                    }

                    echo '<tr>
                            <th rowspan="5">Prix Total</th>
                            <td>'.$prixTotalArticles.'€</td>
                            </tr>
                            <tr>
                                <td>Frais de ports : 10€</td>
                            </tr>';

                    $prixTotal=0;
                    $frais=10;

                    $prixTotal=$prixTotalArticles+$frais;

                    echo '<tr>
                            <td>Total : '.$prixTotal.'€</td>
                        </tr>';
                  
                ?>      
                unset($_SESSION['messageretour']);
                 
            </table> 
            <br>      
            <button onclick="location.href='../Accueil/index.php';">Poursuivre mes achats</button>
            <button onclick="location.href='../Acheteur/verificationCommande.php';">Finaliser la commande</button>  
        </div>
    </body>
</html>