<?php 
    //identifier la BDD
    $database = "ecebay";

    // se connecter à la BDD
    $db_handle = mysqli_connect('localhost', 'root', '');
    $db_found = mysqli_select_db($db_handle, $database);
    if (!$db_found)
        die("Database not found !");
    $id=(isset($_SESSION["UserID"])?$_SESSION["UserID"]:"");
?>

<div class="histo-achat col-lg-8 col-sm-3 col-xs-2 mx-auto">
    <table class="table">
        <?php

        $sql= "SELECT DISTINCT E.ID, Prix_Max, Prix_Encheres, Nom, Description, File, I.ID as ID_Item
                FROM encheres E, items I, medias M
                WHERE E.ID_Acheteur = '$id' AND M.ID_Item = I.ID AND E.ID_ITEM = M.ID_Item AND M.indx='0'";
        //echo $sql;
        
        $result = mysqli_query($db_handle, $sql);
        
        if (!$result)
            die("");

        while ($row = $result->fetch_assoc()){
        ?>    
        <tr style="text-align: justify;">
            <td style="text-align: center">
            <?php $image=$row['File'];
                print '<img onclick="location.href=\'../Produit/index.php?id=' . $row["ID_Item"] . '\';" src="../UploadedContent/'.$image.'" style="max-width: 10em; max-height: 8em;"/>';
            ?>
            </td>
            <td style="padding: 5px; padding-right: 15px;">
                <p><strong><?php echo $row['Nom'] ;?></strong></p>
                <p><?php echo $row['Description'];?> </p>
            </td>
            <td>
                Prix actuel <br>
                <?php echo $row['Prix_Encheres'];?>
            </td>
            <td>
            	Votre enchère<br>
                <?php echo $row['Prix_Max'];?>
            </td>
        </tr>
        
        <?php } ?>
    </table>

</div>


