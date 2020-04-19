
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
                            <td><img style="max-width: 10em; max-height: 10em" src="../UploadedContent/'. (($img!="") ? $img : 'blank.png') . '" ></td>';

                    echo '<td style="padding-left: 1em;">
                            <strong>'.$row["Nom"].'</strong><br>
                            Prix : '.$row["Prix"].'€
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