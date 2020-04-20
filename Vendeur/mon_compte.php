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
                <?php
				    if (!isset($_SESSION['UserType']) || !isset($_SESSION['UserID']))
				        echo '<script> window.location = "../CreerCompte/connexion.php"; </script>';
				    
				    if ($_SESSION['UserType'] != "Vendeur") 
				        echo '<script> window.location = "../CreerCompte/connexion.php"; </script>';
				    
				    $db_handle = mysqli_connect('localhost', 'root', '');
				    $db_found = mysqli_select_db($db_handle, 'ecebay');
				    
				    if (!$db_found)
				        die ("Impossible d'accéder à la base de donnée");
				        
			        $query = "SELECT * FROM vendeurs WHERE ID=".$_SESSION['UserID'];
			        $result = mysqli_query($db_handle, $query);
			        
			        if (!$result)
			            die ('<script> alert("Erreur lors de la requète"); window.location = "../Accueil/index.php"; </script>');
			        $user = $result->fetch_assoc();
			        
			        if (empty($user))
			            die ('<script> alert("Erreur lors de la requète : aucune info sur ce vendeur"); window.location = "../Accueil/index.php"; </script>');
			    ?>
			    
                <div class="container-fluid" >
                    <div class="row" >
                        <div class="leftnavbartop col-lg-2 col-sm-4 col-xs-3">
                            <a><img class="rounded-circle" src="../UploadedContent/<?php echo ($user["PP"]!=""?$user["PP"]:"user-default.png"); ?>" style="max-width: 8em; max-height: 8em;"></a> <br>
                            
				
			     <?php
			        echo '<a style="color: #fff; ">'. $user["Prenom"] ." ". $user["Nom"] .'</a>';
			        echo '<a style="color: #fff;" href="../Vendeur/boutique.php?id='.$user["ID"].'">'. $user["Boutique"] .'</a>';
			     ?>
			     
                        </div>

                        <div class="topright col-lg-5 mx-auto"  style=float:none>
                            <?php
                            $page = isset($_GET["page"])?$_GET["page"]:"";
                            switch ($page) {
                                case "info": echo 'Informations personelles'; break;
                                case "infobancaires": echo 'Moyen de paiements'; break;
                                case "historique": echo 'Historique des ventes'; break;
                                case "evaluation": echo 'Evaluations reçues'; break;
                                case "offres": echo 'Offres en cours'; break;
                                case "modifierPP": echo 'Modifier mon profil'; break;
                                default: echo 'MON COMPTE'; 
                            } ?>
                        </div>
                    </div>
                
                    <div class="row ">
                    	<div class="leftnavbar navbar-expand-lg col-lg-2 col-sm-4 col-xs-3">
                         	<a href="../Vendeur/mon_compte.php" style="font-size: 15px; margin-top: 2%; text-decoration: underline overline; margin-left: 8%"> TABLEAU DE BORD</a>
                         	<button class="navbar-toggler navbar-light container-fluid" type="button" data-toggle="collapse" data-target="#leftPanel">
                    			<span class="navbar-toggler-icon"></span>
                    		</button>
            				<div class="collapse show" id="leftPanel">
                             <!-- Mettre les liens-->
                                <hr>
                                <a href="../Vendeur/mon_compte.php?page=info">Informations personelles</a>
                                <hr>
                                <a href="../Vendeur/mon_compte.php?page=infobancaires">Informations bancaires</a>
                                <hr >
                                <a href="../Vendeur/mon_compte.php?page=historique">Historique des ventes</a>
                                <hr>
                                <a href="../Vendeur/mon_compte.php?page=offres">Offres en cours</a>
                                <hr>
                                <?php echo '<a href="../Vendeur/boutique.php?id='.$_SESSION['UserID'].'">Ma boutique</a>'; ?>
                                <hr>
                                <a href="../Vendeur/mon_compte.php?page=evaluation">Evaluations reçues</a>
                                <hr>
                                <a href="../Vendeur/mon_compte.php?page=modifierPP">Modifier photos</a>
                                <hr>
                                <a href="../deconnexion.php">Déconnexion</a>
                    
                            </div>
                		</div>
                		<?php
                            $page = isset($_GET["page"])?$_GET["page"]:"";
                            if ($page!="")
                                include '../Vendeur/'.$page.'.php';
                            else
                                include '../Vendeur/tableau_de_bord.php';
                        ?>
                	</div>
                

    </body>
</html>

<?php include '../footer.html' ?>


