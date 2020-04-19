<!DOCTYPE html>
<html>
    <head >
        <meta charset= "utf-8">
        <meta name= "viewport" content= "width=device-width, initial-scale=1">

        <!-- importing bootstrap-->
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

        <title>Informations Acheteur ECEbay</title>

        <script type="text/javascript">
            function ajouterAuPanier(id1, id2)
            {
                window.location.href = "../Acheteur/ajouterAvis.php?id1=" + id1 + "&id2=" + id2;
            }
        </script>

    </head>

    <body>
        <?php
        include '../header.php';
        ?>

        <h6><a href="javascript:history.back()"><- Retour aux résultats</a></h6>

        <div class="achatpasse col-lg-6 col-sm-3 col-xs-2 mx-auto table-responsive">
            <h3>Mon Historique d'achats </h3>

            <table type="table" >

    <?php

        $db_handle = mysqli_connect('localhost', 'root', '');
        $db_found = mysqli_select_db($db_handle, 'ecebay');

        if (!$db_found) { die('Database not found'); }

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

        $id=(isset($_SESSION["UserID"])?$_SESSION["UserID"]:"");

        $query = "SELECT * FROM items WHERE ID IN (SELECT Id_Item FROM paniers WHERE ID_Acheteur=".$id.")";
        $result = mysqli_query($db_handle, $query);

                if (!$result)
                {
                    die('Couldn\'t find table');
                }

                $prixTotalArticle=0;

                $prixTotalArticles=0;

                $item=0;

                $ID_Acheteur=0;

                while($row = $result->fetch_assoc()) 
                {   
                    /*on récupère les données de la table medias*/
                    $img = mysqli_query($db_handle, "SELECT File FROM medias WHERE ID_Item=" . $row["ID"] . " AND indx = 0;")->fetch_assoc() ["File"];

                    echo'   
                                <tr style="text-align: justify;">
                                    <td>
                                        <img style="max-width:10em ;" src="../UploadedContent/'. (($img!="") ? $img : 'blank.png') . '" >
                                    </td>
                                    <td style="padding: 5px; padding-right: 15px;">
                                        <p class="nomproduit"><strong>Nom produit</strong>'.$row["Nom"].'</p>
                                        <p class="description">Description Produit : '.$row["Description"].'</p>
                                    </td>
                                    <td>
                                        <p class="prix">Prix : '.$row["Prix"].'€</p>
                                    </td>
                                    <td>
                                        <ul class="nav nav-tabs">
                                            <li class="nav-item">
                                                <a class="nav-link " data-toggle="tab" href="#commentaires"><button data-toggle="collapse" data-target="#demo">Laisser un avis</button></a>
                                            </li>
                                        </ul>
                                        <br>
                                        <!-- Tab panes -->
                                        <div class="tab-content">
                                            <div class="tab-pane container active" id="commentaires">
                                                <div id="demo" class="collapse">
                                                    <form method="post" action="avis.php">
                                                        <input type="text" class="form-control" placeholder="Entrez votre avis" name="avis">
                                                        <button type="submit" class="btn btn-primary"><a style="color:white;" href="javascript:ajouterAvis(' . $item["ID"] . ', ' . $ID_Acheteur . ','.$avis.');"> Envoyer</a></button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>                        
                                </tr>';  
                }
    ?>

        </table>
    </div>
    </body>
</html>