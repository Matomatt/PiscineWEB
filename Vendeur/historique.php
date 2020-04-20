
<div class=" col-lg-8 col-sm-3 col-xs-2 mx-auto" style="float:none; text-align: center;  ">
<table type="table" border=1 frame=void rules=rows>

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
    
    if ($_SESSION["UserType"] != "Vendeur")
    {
        die('<script>
                alert("Veuillez vous connecter à votre compte Acheteur");
                window.location = "../CreerCompte/connexion.php";
            </script>');
    }

    $id=(isset($_SESSION["UserID"])?$_SESSION["UserID"]:"");

    $query = "SELECT * FROM transactions WHERE ID_Item IN (SELECT ID FROM items WHERE ID_Vendeur=".$id.") ORDER BY Date DESC";
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
                    <img onclick="location.href=\'../Produit/index.php?id=' . $row["ID_Item"] . '\';" style="max-width:10em; max-height: 8em; margin-right: 2em; margin-bottom: 1em" src="../UploadedContent/'. (($img!="") ? $img : 'blank.png') . '" >
                </td>
                <td style="vertical-align:top;">
                    <div style="margin-top: 0.3em;">
                        <strong>'.$item["Nom"].'</strong><br>
                        Prix : '.$row["Montant"].'€<br>
                        Livraison : '.$row["Prix_livraison"].'€
                    </div>
                </td>
            </tr>';  
    }
?>

</table>
</div>