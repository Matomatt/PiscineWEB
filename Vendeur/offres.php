<?php
    include '../nav.html';
    session_start();

    //identifier la BDD
    $database = "ecebay2";

    // se connecter à la BDD
    $db_handle = mysqli_connect('localhost', 'root', '');
    $db_found = mysqli_select_db($db_handle, $database);
    $id=(isset($_SESSION["UserID"])?$_SESSION["UserID"]:"");
?>

<div class="container-fluid">
    <div class="offres col-lg-7 mx-auto"  style=float:none>

        <table type="table">
            <?php
                    $id=(isset($_SESSION["UserID"])?$_SESSION["UserID"]:"");


                    $sql= "SELECT Nom, File, O.ID as Oid
                    FROM offres O, items I, medias M
                    WHERE I.ID_Vendeur = '$id' AND M.ID_Item =  I.ID AND O.ID_Item = M.ID_Item AND M.indx ='0'";

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
                            <p><strong><?php echo $row['Oid'] ;?></strong></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <form action='#' method='post'>;
                        <input type='submit' name='Accepter' value="Accepter">
                        <!--ID (offre) de l'item en question -->
                        <?php
                        $var = $row['Oid'];
                        echo $var;?>

                            <form>
                        </td>
                        <td>
                            <form action="#" method="post">
                                <input type="submit" name="Refuser" value="Refuser">

                            <form>
                        </td>
                            <td>
                            <form action="#" method="post">
                                <input type="submit" name="ContreOffre" value="Contre Offre">
                            <form>
                        </td>
                    </tr>
                    </table>
                    <?php } ?>

   

   
    </div>
</div>