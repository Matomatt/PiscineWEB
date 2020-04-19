<!DOCTYPE html>

<html>
    <head>

        <link rel="stylesheet" type="text/css" href="style.css">


        <!--accents-->
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" >
        <!--reseting my viewport, for making my website responsive-->
        <meta name="viewport" content="width=device-width, initial-scale=1"> 
        <!-- importing bootstrap-->
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <!--external style sheet-->

    </head>

<body>
	<?php include '../header.php'; 
    ?>

    <div class="container-fluid">
        <div class="row" >
            <div class="col-xs-8 col-sm-7 col-lg-9  mx-auto"  style=float:none>
                <div class="banniere ">   
                    <div class="opacite col-xs-6 col-lg-9 col-sm-5  mx-auto"  style=float:none>
                        <div class="gauche">

                            <?php

                                $ID_Vendeur=isset($_GET["id"])?$_GET["id"]:0;
                                $query = "SELECT * FROM vendeurs WHERE ID=".$ID_Vendeur."";
                                $result = mysqli_query($db_handle, $query);

                                if (!$result)
                                {
                                  die('Couldn\'t find table');
                                }

                                $row = $result->fetch_assoc();

                            

                                echo '<p><strong>Nom de la Boutique : </strong>'.$row["Boutique"].' </p><br>
                                    <p><strong>Contact : </strong>'.$row["Email"].'<br>'.$row["Telephone"].'</p><br>';
                            ?>

                            <?php

                                $ID_Vendeur=$_SESSION["UserID"];
                                $query = "SELECT * FROM notes WHERE ID_Vendeur=".$ID_Vendeur."";
                                $result = mysqli_query($db_handle, $query);

                                if (!$result)
                                {
                                  die('Couldn\'t find table');
                                }

                                echo '</div>        
                                      <div class="droite">
                                        <p><strong>Notes : </strong><br>';

                                $i=0;
                                $sommeNotes=0;
                                $moyenne=0;

                                while($row = $result->fetch_assoc()) 
                                { 
                                    echo $row["Note"].'<br>';
                                    $sommeNotes=$sommeNotes+$row["Note"];
                                    ++$i; 
                                }

                                echo 'Moyenne = '.$sommeNotes/$i.'';

                                echo '</p>
                                    </div>';
                            ?>
                        
                    </div>
                    <div class="Images/avatar col-xs-4 col-lg-3 col-sm-3  mx-auto "  style="float:none; margin-top: -20%;">
                        <img  src="../Images/avatar.jpg" class="img-circle" style="max-width: 50%; margin-top: 2%; margin-left: 15%;">
                    </div>
                </div>
            </div>
        </div>

         <div class="row "  style="margin-top: 10%;">
            <div class="col-lg-3 col-sm-4 col-xs-4">
                <h3>Objets en vente</h3> <br>
            </div>
         </div>

        <div class="col-xs-8 col-sm-7 col-lg-8  mx-auto"  style=float:none>
            <div class="row ">
        
                <?php

                $ID_Vendeur=isset($_GET["id"])?$_GET["id"]:0;
                $query = "SELECT * FROM items WHERE ID_Vendeur=".$ID_Vendeur." AND Vendu=0";
                $result = mysqli_query($db_handle, $query);

                if (!$result)
                {
                  die('Couldn\'t find table');
                }

                while($row = $result->fetch_assoc()) 
                { 
                    /*on récupère les données de la table medias*/
                    $img = mysqli_query($db_handle, "SELECT File FROM medias WHERE ID_Item=" . $row["ID"] . " AND indx = 0;")->fetch_assoc() ["File"];
                    echo'<div class="col-sm-3">
                            <img class="img-thumbnail" src="../UploadedContent/'. (($img!="") ? $img : 'blank.png') . '" >  
                            <strong>'.$row["Nom"].'</strong><br>
                            Prix : '.$row["Prix"].'€ <br>
                            Quantité : '.$row["Quantite"].'<br>
                        </div>';
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>

<?php include '../footer.html' ?>