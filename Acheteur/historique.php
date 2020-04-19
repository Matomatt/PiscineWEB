
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

    $query = "SELECT * FROM transactions WHERE ID_Acheteur=".$id." ORDER BY Date DESC";
    $result = mysqli_query($db_handle, $query);

    if (!$result)
    {
        die('Couldn\'t find table');
    }

    while($row = $result->fetch_assoc()) 
    {
        /*on récupère les données de la table medias*/
        $img = mysqli_query($db_handle, "SELECT File FROM medias WHERE ID_Item=" . $row["ID_Item"] . " AND indx = 0;")->fetch_assoc() ["File"];
        $item = mysqli_query($db_handle, "SELECT * FROM items WHERE ID=" . $row["ID_Item"] . ";")->fetch_assoc();

        echo' <tr style="text-align: justify;">
                <td style="text-align: center">
                    <img style="max-width:10em; max-height: 8em;" src="../UploadedContent/'. (($img!="") ? $img : 'blank.png') . '" >
                </td>
                <td style="padding: 5px; padding-right: 15px;">
                    <strong>'.$item["Nom"].'</strong><br>
                    Prix : '.$row["Montant"].'€<br>
                    Livraison : '.$row["Prix_livraison"].'€
                </td>
                <td>
                    <ul class="nav nav-tabs">
                        <li class="nav-item">';
                            
        
        $note = mysqli_query($db_handle, "SELECT * FROM notes WHERE ID_Item=" . $row["ID_Item"] . " AND ID_Acheteur=".$id.";");
        $good=0;
        if ($note)
        {
            $note = $note->fetch_assoc();
            if ($note["ID"] != "")
            {
                echo '<a class="nav-link " data-toggle="tab"><button data-toggle="collapse" data-target="#demo'.$row["ID"].'">Mon avis</button></a>
                        </li>
                    </ul>
                    <br>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane container active">
                        <div id="demo'.$row["ID"].'" class="collapse">' .
                            $note["Commentaire"] . '<br>' . $note["Note"]/2 . '&#9733';
                $good=1;
            }
        }
        if ($good==0)
            echo '<a class="nav-link " data-toggle="tab"><button data-toggle="collapse" data-target="#demo'.$row["ID"].'">Laisser un avis</button></a>
                        </li>
                    </ul>
                    <br>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane container active">
                            <div id="demo'.$row["ID"].'" class="collapse">
                                <form method="post" action="ajouterAvis.php?id1='.$row["ID_Item"].'&id2='.$row["ID_Vendeur"].'&id3='.$id.'">
                                    <input type="text" placeholder="Entrez votre avis" name="commentaire"\>
                                    <input type="number" min="0" max="10" placeholder="Note" name="note"\>
                                    <button type="submit" class="btn btn-primary">Envoyer</button>
                                </form>';
                       echo '</div>
                        </div>
                    </div>
                </td> 

            </tr>';  
    }
?>

</table>