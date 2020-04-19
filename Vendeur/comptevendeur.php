<!DOCTYPE html>

<html>
    <head >
        <meta charset= "utf-8">
        <meta name= "viewport" content= "width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="style.css">


        <link rel= "stylesheet" href= "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src= "https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.j s"> </script>
        <script src= "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/j s/bootstrap.min.j s"> </script>
        <link rel="stylesheet"href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
       <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>


       <!-- Popper JS -->
       <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
       <!-- external java sheet-->
       <script type="text/javascript" src="accueil.js"></script>
    </head>

    <body >


        <nav class="navbar navbar-expand-md"></nav>

                <div class="container-fluid" >
                    <div class="row" >
                        <div class="leftnavbartop col-lg-2 col-sm-4 col-xs-3">
                            <a><img class="rounded-circle" src="../Images/avatar.jpg" style="max-width: 50%;"></a>
                            <br>
                            <a style="color: #fff; ">Mon nom</a>
                            <a style="color: #fff; ">Nom de ma boutique</a>
                             
                        </div>

                        <div class="topright col-lg-5 center-block"  style=float:none>
                            GERER MA BOUTIQUE
                        </div>
                    </div>
                
                    <div class="row">
                        <div class="leftnavbar col-lg-2 col-sm-4 col-xs-pull-3">
                            
                         <!-- Mettre les liens-->
                         <a href="compte%20vendeur.html"> TABLEAU DE BORD</a>
                            <a href="info.html">Informations personelles</a>
                            <hr  color="grey" ">
                            <a href="#">Informations bancaires</a>
                            <hr color="grey" ">
                            <a href="#">Historique des ventes</a>
                            <hr color="grey" ">
                            <a href="#">Enchères en cours</a>
                            <hr color="grey" ">
                            <a href="#">Les offres de négociation</a>
                            <hr color="grey" ">
                            <a href="pagevendeur.html">Profil public boutique</a>
                            <hr color="grey" ">
                            <a href="#">Mes paramètres</a>
                            <hr color="grey" ">
                            <a href="../deconnexion.php">Déconnexion</a>
                
                        </div>


                        <div class="PublierItem " >
                            <div class="col-lg-10 col-xs-5">
                                <h3>Publier un produit</h3>
                                <button class="btn btn-primary" onclick="">Ajouter une fiche produit</button>

                            </div>
            
                        </div>
                        <div class="AddSupprItem" >
                            <div class="col-lg-10 col-xs-5">
                                <h3>Gérer mes produit</h3>
                                <button class="btn btn-primary" onclick="">Modifier un produit</button><br>
                                <button class="btn btn-primary" onclick="">Supprimer un produit</button>

                            </div>
                        </div>
                    </div>
                </div>

    </body>
</html>


