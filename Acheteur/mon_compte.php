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
                
                <div class="container-fluid" >
                    <div class="row" >
                        <div class="leftnavbartop col-lg-2 col-sm-4 col-xs-3">
                            <a><img class="rounded-circle" src="../Images/avatar.jpg" style="max-width: 50%;"></a> <br>
                            
				<?php
				    if (!isset($_SESSION['UserType']) || !isset($_SESSION['UserID']))
				        echo '<script> window.location = "../CreerCompte/connexion.php"; </script>';
				    
				    if ($_SESSION['UserType'] != "Acheteur") 
				        echo '<script> window.location = "../CreerCompte/connexion.php"; </script>';
				    
				    $db_handle = mysqli_connect('localhost', 'root', '');
				    $db_found = mysqli_select_db($db_handle, 'ecebay');
				    
				    if (!$db_found)
				        die ("Impossible d'accéder à la base de donnée");
				        
			        $query = "SELECT * FROM acheteurs WHERE ID=".$_SESSION['UserID'];
			        $result = mysqli_query($db_handle, $query);
			        
			        if (!$result)
			            die ('<script> alert("Erreur lors de la requète"); window.location = "../Accueil/index.php"; </script>');
			        $user = $result->fetch_assoc();
			        
			        if (empty($user))
			            die ('<script> alert("Erreur lors de la requète : aucune info sur cet acheteur"); window.location = "../Accueil/index.php"; </script>');
			        
			        echo '<a style="color: #fff; ">'. $user["Prenom"] ." ". $user["Nom"] .'</a>';
			     ?>
			     
                        </div>

                        <div class="topright col-lg-5 mx-auto"  style=float:none>
                            <?php
                            $page = isset($_GET["page"])?$_GET["page"]:"";
                            switch ($page) {
                                case "info": echo 'Informations personelles'; break;
                                case "infobancaires": echo 'Moyen de paiements'; break;
                                case "historique": echo 'Historique des achats'; break;
                                case "encheres": echo 'Enchères en cours'; break;
                                case "offres": echo 'Offres en cours'; break;
                                case "parametres": echo 'Paramètres'; break;
                                default: echo 'MON COMPTE'; 
                            } ?>
                        </div>
                    </div>
                
                    <div class="row ">
                        <div class="leftnavbar col-lg-2 col-sm-4 col-xs-3">
                            
                         <!-- Mettre les liens-->
                         <a href="../Acheteur/mon_compte.php" style="font-size: 15px; margin-top: 2%; text-decoration: underline overline;"> TABLEAU DE BORD</a>
                            <a href="../Acheteur/mon_compte.php?page=info">Informations personelles</a>
                            <hr  color="grey" ">
                            <a href="../Acheteur/mon_compte.php?page=infobancaires">Informations bancaires</a>
                            <hr color="grey" ">
                            <a href="../Acheteur/mon_compte.php?page=historique">Historique des achats</a>
                            <hr color="grey" ">
                            <a href="../Acheteur/mon_compte.php?page=encheres">Enchères en cours</a>
                            <hr color="grey" ">
                            <a href="../Acheteur/mon_compte.php?page=offres">Les offres</a>
                            <hr color="grey" ">
                            <a href="../Acheteur/mon_compte.php?page=parametres">Mes paramètres</a>
                            <hr color="grey" ">
                            <a href="../deconnexion.php">Déconnexion</a>
                
                        </div>
                
                		<?php
                            $page = isset($_GET["page"])?$_GET["page"]:"";
                            if ($page!="")
                                include '../Acheteur/'.$page.'.php';
                            else
                                include '../Acheteur/tableau_de_bord.php';
                        ?>
                        
                        
                <br>
                
                </div>
                

    </body>
</html>

