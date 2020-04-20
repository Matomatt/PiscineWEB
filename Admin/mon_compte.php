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
	    
	    if ($_SESSION['UserType'] != "Admin") 
	        echo '<script> window.location = "../CreerCompte/connexion.php"; </script>';
	    
	    $db_handle = mysqli_connect('localhost', 'root', '');
	    $db_found = mysqli_select_db($db_handle, 'ecebay');
	    
	    if (!$db_found)
	        die ("Impossible d'accéder à la base de donnée");
    ?>
    
    <div class="container-fluid" >
        <div class="row" >
            <div class="leftnavbartop col-lg-2 col-sm-4 col-xs-3" style="text-align: center;">
          		<h1 style="color: #fff; margin-top: 0.4em">ADMIN</h1>
            </div>

            <div class="topright col-lg-5 mx-auto"  style="float: none;">
                <?php
                $page = isset($_GET["page"])?$_GET["page"]:"";
                switch ($page) {
                    case "vendeurs": echo 'Gérer les vendeurs'; break;
                    case "produits": echo 'Gérer les produits'; break;
                    default: echo 'MON COMPTE'; 
                } ?>
            </div>
        </div>
    
        <div class="row">
        	<div class="leftnavbar navbar-expand-lg col-lg-2 col-sm-4 col-xs-3">
             	<a href="../Admin/mon_compte.php" style="font-size: 15px; margin-top: 2%; text-decoration: underline overline; margin-left: 8%"> TABLEAU DE BORD</a>
             	<button class="navbar-toggler navbar-light container-fluid" type="button" data-toggle="collapse" data-target="#leftPanel">
        			<span class="navbar-toggler-icon"></span>
        		</button>
				<div class="collapse show" id="leftPanel">
                 <!-- Mettre les liens-->
                    <hr>
                    <a href="../Admin/mon_compte.php?page=vendeurs">Gérer les vendeurs</a>
                    <hr>
                    <a href="../Admin/mon_compte.php?page=produits">Gérer les produits</a>
                    <hr>
                    <a href="../deconnexion.php">Déconnexion</a>
        
                </div>
    		</div>
    		
    		<div class="col-lg-8">
        		<?php
                    $page = isset($_GET["page"])?$_GET["page"]:"";
                    if ($page!="")
                        include '../Admin/'.$page.'.php';
                    else
                        include '../Admin/tableau_de_bord.php';
                ?>
            </div>
    	</div>
    
	<?php include '../footer.html' ?>
</body>
</html>




