<?php 
    session_start();

    //identifier la BDD
    $database = "ecebay2";

    // se connecter à la BDD
    $db_handle = mysqli_connect('localhost', 'root', '');
    $db_found = mysqli_select_db($db_handle, $database);
    $id=(isset($_SESSION["UserID"])?$_SESSION["UserID"]:"");
?>

<div class="histo-achat col-lg-8 col-sm-3 col-xs-2 mx-auto" style=float:none;>      
  
 <div class="achatpasse">
     <h3>Mes enchères en cours </h3>
    <table type="table" >
        <?php

        $sql= "SELECT Prix_Max,Prix_Encheres, Nom, Description, File
                FROM encheres E, items I, medias M
                WHERE E.ID_Acheteur = '$id' AND M.ID_Item =  I.ID AND E.ID_ITEM = M.ID_Item AND M.indx ='0'";
        $result = mysqli_query($db_handle, $sql);

        while ($row = mysqli_fetch_array($result)){
        ?>    
        <tr style="text-align: justify;">
            <td>
            <?php $image=$row['File'];
                print '<img src="$image />';
            ?>
            </td>
            <td style="padding: 5px; padding-right: 15px;">
                <p><strong><?php echo $row['Nom'] ;?></strong></p>
                <p><?php echo $row['Description'];?> </p>
            </td>
            <td>
                <p><?php echo $row['Prix_Encheres'];?></p>
            </td>
            <td>
                <p><?php echo $row['Prix_Max'];?></p>
            </td>
        </tr>
        
        <?php } ?>

</div>

</div>


