<?php 
    session_start();

    //identifier la BDD
    $database = "ecebay";

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
                WHERE E.ID_Acheteur = '$id' AND M.ID_Item =  I.ID AND E.ID_ITEM = M.ID_Item";
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
        <table type="table" >
            <tr style="text-align: justify;">
                <td>
                     <img src="../Images/pic.png" style="max-width: auto;">
                </td>
                   <td style="padding: 5px; padding-right: 15px;">
                       <p class="nomproduit"><strong>Nom produit</strong></p>
                       <p class="description">Description Produit Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Fuga et veritatis voluptas reprehenderit iste iusto ducimus! </p>
                   </td>
                  <td>
                     <p class="prix">Prix enchéri</p>
                </td>
                <td>
                    <p class="prix">Enchère actuelle</p>
               </td>
               <td>
                <p class="temps">Temps restant</p>
             </td>

            </tr>
    </table>
</div>

</div>


