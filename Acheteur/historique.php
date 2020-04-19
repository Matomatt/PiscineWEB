
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
        /*sauvegarder les données pour utilisation dans ajouterAvis.php*/
        $_SESSION["vID_Item"]=$row["ID"];
        $_SESSION["vID_Vendeur"]=$row["ID_Vendeur"];

        /*on récupère les données de la table medias*/
        $img = mysqli_query($db_handle, "SELECT File FROM medias WHERE ID_Item=" . $row["ID"] . " AND indx = 0;")->fetch_assoc() ["File"];

        echo' <tr style="text-align: justify;">
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
                                <form method="post" action="ajouterAvis.php">
                                    <input type="text" class="form-control" placeholder="Entrez votre avis" name="commentaire">
                                    <button type="submit" class="btn btn-primary">Envoyer</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </td> 

            </tr>';  
    }
?>

</table>