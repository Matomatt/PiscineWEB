<!DOCTYPE html>

<html>
    <head >
        <meta charset= "utf-8">
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

    </head>

    <body >

                <?php include '../header.php'; ?>
				<h1>
				<?php
				    if (isset($_SESSION['UserType']))
				    {
				        echo $_SESSION['UserType'] . " n°";
				    }
			        if (isset($_SESSION['UserID']))
			        {
			            echo $_SESSION['UserID'];
			        }
				?>
				</h1>
                <div class="container-fluid" >
                    <div class="row" >
                        <div class="leftnavbartop col-lg-2 col-sm-4 col-xs-3">
                            <a><img class="rounded-circle" src="../Images/avatar.jpg" style="max-width: 50%;"></a>
                            <br>
                            <a style="color: #fff; ">Mon nom</a>
                             
                        </div>

                        <div class="topright col-lg-5 mx-auto"  style=float:none>
                            MON COMPTE
                        </div>
                    </div>
                
                    <div class="row ">
                        <div class="leftnavbar col-lg-2 col-sm-4 col-xs-3">
                            
                         <!-- Mettre les liens-->
                         <a href="compteclient.php" style="text-align: center; font-size: 15px; margin-top: 2%;"> TABLEAU DE BORD</a>
                            <a href="info.php">Informations personelles</a>
                            <hr  color="grey" ">
                            <a href="#">Informations bancaires</a>
                            <hr color="grey" ">
                            <a href="historique.php">Historique des achats</a>
                            <hr color="grey" ">
                            <a href="encheres.php">Enchères en cours</a>
                            <hr color="grey" ">
                            <a href="offres.php">Les offres</a>
                            <hr color="grey" ">
                            <a href="#">Mes paramètres</a>
                            <hr color="grey" ">
                            <a href="../deconnexion.php">Déconnexion</a>
                
                        </div>
                
                        <div class="wishlist col-lg-4"  style=float:none >
                            <div class="col-lg-5 col-xs-5">
                                <h3>Ma wishlist</h3>
                                <table type="table" >
                                    <tr style="text-align: justify;">
                                        <td>
                                            <img src="../Images/pic.png">
                                        </td>
                                        <td style="padding: 5px; padding-right: 10px;">
                                         <p class="nomproduit"><strong>Nom produit</strong></p>
                                         <p class="description " style="width:150px;">Description Produit Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                            Fuga et veritatis voluptas reprehenderit iste iusto ducimus! </p>
                                        </td>
                                        <td>
                                            <p class="prix">Prix </p>
                                       </td>
                                        <td>
                                            <button style="margin-left:15px;">Supprimer</button>
                                        </td>
                                     </tr>
                                                    
                                     <tr style="text-align: justify;">
                                        <td>
                                            <img src="../Images/pic.png" >
                                        </td>
                                        <td style="padding: 5px; padding-right: 15px;">
                                         <p class="nomproduit"><strong>Nom produit</strong></p>
                                         <p class="description">Description Produit Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                            Fuga et veritatis voluptas reprehenderit iste iusto ducimus! </p>
                                        </td>
                                        <td>
                                            <p class="prix">Prix </p>
                                       </td>
                                        <td>
                                            <button style="margin-left:15px;">Supprimer</button>
                                        </td>
                                     </tr>
                                     <tr style="text-align: justify;">
                                        <td>
                                            <img src="../Images/pic.png">
                                        </td>
                                        <td style="padding: 5px; padding-right: 15px;">
                                         <p class="nomproduit"><strong>Nom produit</strong></p>
                                         <p class="description">Description Produit Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                            Fuga et veritatis voluptas reprehenderit iste iusto ducimus! </p>
                                        </td>
                                        <td>
                                            <p class="prix">Prix </p>
                                       </td>
                                        <td>
                                            <button style="margin-left:15px;">Supprimer</button>
                                        </td>
                                     </tr>
                                     <tr style="text-align: justify;">
                                        <td>
                                            <img src="../Images/pic.png">
                                        </td>
                                        <td style="padding: 5px; padding-right: 15px;">
                                         <p class="nomproduit"><strong>Nom produit</strong></p>
                                         <p class="description">Description Produit Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                            Fuga et veritatis voluptas reprehenderit iste iusto ducimus! </p>
                                        </td>
                                        <td>
                                            <p class="prix">Prix </p>
                                       </td>
                                        <td>
                                            <button style="margin-left:15px;">Supprimer</button>
                                        </td>
                                     </tr>
                                </table>

                            </div>
            
                        </div>
                        <div class="enchere col-lg-4" >
                            <div class="col-lg-2 col-xs-5">
                                <h3>Consulté dernièrement</h3>
                                <
                                <button class="btn btn-primary" onclick="">Modifier un produit</button><br>
                                <button class="btn btn-primary" onclick="">Supprimer un produit</button>

                            </div>
                        </div>
                <br>
                
                </div>
                

    </body>
</html>


