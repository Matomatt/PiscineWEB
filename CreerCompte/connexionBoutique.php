<!DOCTYPE html>

<html>
<head>
    <title>Connexion - ECEbay</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style2.css">
    
    

    <script
    	src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.j s"
    	type="text/javascript"> </script>
    <script
    	src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/j s/bootstrap.min.j s"
    	type="text/javascript"> </script>
    <link rel="stylesheet"
    	href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    	type="text/javascript"></script>
    <script
    	src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
    	type="text/javascript"></script>

</head>

<body>
	<div class="container">
        <?php include "../header.php" ?>
        <div class="connexion col-lg-6 mx-auto" style="float: none;">
			<h2 style="text-align: center;">Bonjour !</h2>
			<h4 style="text-align: center;">Vous êtes vendeurs ? Saissisez vos identifiants pour vous connecter</h4>
				
			<form action="connexionTraitement.php" method="post"
				style="text-align: center; margin-top: 30px; margin-bottom: 30px;">
				Adresse e-mail : <br> <input type="email" placeholder="e-mail" name="email"><br> 
				Mot de passe :<br> <input type="password" placeholder="mot de passe" name="mdp"><br> 
				<input type="submit" name='bouton2' value="Se connecter"><br>
			</form>
			
			<hr width="40%" color="grey" style="margin-top: 20px; margin-bottom: 20px;">
			<p style="text-align:center">
			<br> Vous n'avez pas encore de compte ?<br> 
			<a href="creercompte.html">Inscrivez vous!</a> <br> Vous voulez vendre ?<br> 
			<a href="creerboutique.html">Créez votre boutique ici !</a></p>
		</div>
	</div>


</body>

</html>