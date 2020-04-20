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
    
<?php 
    $db_handle = mysqli_connect('localhost', 'root', '');
    $db_found = mysqli_select_db($db_handle, 'ecebay');
    
    if (!$db_found) { die('Database not found'); }

	$id=(isset($_SESSION["UserID"])?$_SESSION["UserID"]:"");
	$ID_Vendeur=isset($_GET["id"])?$_GET["id"]:0;
	
	$query = "SELECT * FROM vendeurs WHERE ID=".$ID_Vendeur;
	$result = mysqli_query($db_handle, $query);
	
	if (!$result)
	{
	    die('Couldn\'t find table');
	}
	
	$vendeur = $result->fetch_assoc();
?>
	
<body>
	<?php include '../header.php'; ?>
	
    <div class="container-fluid">
        <div class="row" >
            <div class="col-xs-8 col-sm-7 col-lg-9  mx-auto"  style=float:none>
                <div class="banniere" style="background-image: url('../UploadedContent/<?php echo ($vendeur["BG"]!=""?$vendeur["BG"]:"blank.png"); ?>')">   
                    <div class="opacite col-xs-6 col-lg-9 col-sm-5  mx-auto"  style=float:none>
                        <div class="gauche">

                            <?php 
                                echo '<br><h4>'.$vendeur["Boutique"].'</h4>
                                    <p><strong>Contact : </strong>'.$vendeur["Email"].'<br>'.$vendeur["Telephone"].'</p>';
                            ?>

                            <?php
                                $query = "SELECT AVG(Note) as moy, COUNT(Note) as nb FROM notes WHERE ID_Vendeur=".$ID_Vendeur."";
                                $result = mysqli_query($db_handle, $query);

                                if (!$result)
                                {
                                  die('Couldn\'t find table');
                                }
                                
                                $notes = $result->fetch_assoc();

                                echo '</div>        
                                      <div class="droite" style="margin-top: 2em">
                                        <p><strong>'.(int)($notes["moy"]/2).'/5 &#9733</strong><br>';

                                echo 'Avec '.$notes["nb"].' notes';

                                echo '</p>
                                    </div>';
                            ?>
                        
                    </div>
                    <div class="Images/avatar col-xs-4 col-lg-3 col-sm-3  mx-auto "  style="float:none; margin-top: -20%;">
                        <img  src="../UploadedContent/<?php echo ($vendeur["PP"]!=""?$vendeur["PP"]:"user-default.png"); ?>" class="img-circle" style="max-width: 50%; margin-top: 2%; margin-left: 15%;">
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
                $query = "SELECT * FROM items WHERE ID_Vendeur=".$ID_Vendeur. ($id==$ID_Vendeur?"":" AND Vendu=0") ." ORDER BY Date_MEV DESC";
                $result = mysqli_query($db_handle, $query);

                if (!$result)
                {
                  die('Couldn\'t find table');
                }

                while($row = $result->fetch_assoc()) 
                { 
                    /*on récupère les données de la table medias*/
                    $img = mysqli_query($db_handle, "SELECT File FROM medias WHERE ID_Item=" . $row["ID"] . " AND indx = 0;")->fetch_assoc() ["File"];
                    echo'<div class="col-sm-3" style="text-align: center">
                            <img onclick="location.href=\'../Produit/index.php?id=' . $row["ID"] . '\';" style="max-height: 10em" src="../UploadedContent/'. (($img!="") ? $img : 'blank.png') . '" ><br>
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