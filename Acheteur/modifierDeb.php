<!DOCTYPE html>

<html>
    <head>
        <meta charset= "utf-8">
        <meta name= "viewport" content= "width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="style2.css">


        <script src= "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/j s/bootstrap.min.j s"> </script>
        <link rel="stylesheet"href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
       <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

    </head>

    <body>



    <div class="container ">
        <?php include "../header.php" ?>
        <div class=" col-lg-9 center-block" style=float:none;>

        <div class="creercompte ">
            <h2 style="text-align: center;">Bonjour ! </h2>
            <h4 style="text-align: center;">Modifiez vos informations.</h4><br>


            <?php

            $db_handle = mysqli_connect('localhost', 'root', '');
            $db_found = mysqli_select_db($db_handle, 'ecebay');

                    if (!$db_found) { die('Database not found'); }

                    /*Pour avoir l'utilisateur connecté*/
                    if (!isset($_SESSION['UserType']) || !isset($_SESSION['UserID']))
                        echo '<script> window.location = "../CreerCompte/connexion.php"; </script>';
                        
                    if ($_SESSION['UserType'] != "Acheteur")
                        echo '<script> window.location = "../CreerCompte/connexion.php"; </script>';
                                            

                    /*Pour avoir id de l'acheteur*/
                    $ID_Acheteur=(isset($_SESSION["UserID"])?$_SESSION["UserID"]:"");
        

        $query="SELECT * FROM acheteurs WHERE ID=".$ID_Acheteur.";" ;
        
        $result = mysqli_query($db_handle, $query);

                    if (!$result)
                    {
                      die('Couldn\'t find table');
                    }
        
        $row = $result->fetch_assoc();

        $nom=$row["Nom"]; 
        $prenom=$row["Prenom"]; 
        $tel=$row["Telephone"]; 

        $query="SELECT * FROM adresses WHERE ID=".$row["ID_Adresse"].";" ;
        
        $result = mysqli_query($db_handle, $query);

                    if (!$result)
                    {
                      die('Couldn\'t find table');
                    }
        
        $row = $result->fetch_assoc();            

        $ad1=$row["Adresse_ligne_1"];
        $ad2=$row["Adresse_ligne_2"]; 
        $ville=$row["Ville"];
        $pays=$row["Pays"];
        $cp=$row["Code_postale"];
       
            ?>
            
        <form method="post" action="modifier.php">

            <div class="row">

                <div class="col-lg-6 col-xs-6 col-md-6" >
                
                    <div class="form-group">
                        <input type="text"  placeholder="Prénom *" value ="<?php echo $prenom;?>" name="prenom" />
                    </div>
                    <div class="form-group">
                        <input type="text"  placeholder="Nom *" name="nom" value ="<?php echo $nom;?>"/>
                    </div>
                
                </div>

           
                <div class="col-lg-6 col-xs-6 col-md-6">

                    <div class="form-group">
                        <input type="tel"  placeholder="Numéro de téléphone *"  value ="<?php echo $tel;?>" name="tel" />
                    </div>
                    <div class="form-group">
                        <input type="text" placeholder="Adresse *" value ="<?php echo $ad1;?>" name="adresse"><br>
                    </div>
                    <div class="form-group">
                        <input type="text" placeholder="Complement d'adresse"  value ="<?php echo $ad2;?>" name="cpadresse"><br>
                    </div>
                    <div class="form-group">
                        <input type="text" placeholder="Ville *" value ="<?php echo $ville;?>" name="ville"><br>
                    </div>
                    <div class="form-group">
                        <input type="number" placeholder="Code Postal *" value ="<?php echo $cp;?>" name="cp"><br>
                    </div>
                    <div class="form-group">
                        <input type="text" placeholder="Pays *"  value ="<?php echo $pays;?>" name="pays"><br>
                    </div>
                    <input type="submit"   value="Modifier" name="bouton1"/>
                </div>
        
            </div>
        </form>
        </div>
        </div>

    </div>

    </body>

</html>