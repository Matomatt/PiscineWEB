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
	<?php include '../header.php'; ?>

    <div class="container-fluid">
        <div class="row" >
            <div class="col-xs-8 col-sm-7 col-lg-9  mx-auto"  style=float:none>
                <div class="banniere ">   
                    <div class="opacite col-xs-6 col-lg-9 col-sm-5  mx-auto"  style=float:none>
                        <div class="gauche">
                            <p><strong>Nom de la Boutique  </strong> </p><br>
                            <p><strong>Contact </strong> </p><br>
                            <p><strong>Objets en vente  </strong> </p><br>                 
                           
                        </div>
                        <div class="droite">
                            <p><strong>
                                Notes
                            </strong></p>
                        </div>
                        
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
            
            <div class="col-lg-3">
                <img class="img-thumbnail " src="../Images/pic.png" >
                <p class="caption"> Lorem ipsum dolor sit amet consectetur adipisicing elit.Blanditiis 
                        aspernatur minus voluptates beatae amet labore rerum saepe commodi est, assumenda nostrum
                         officia, doloribus, voluptate modi sapiente dolorum libero culpa qui! </p>
                </div>
                <div class="col-lg-3" >			
                    <img class="img-thumbnail" src="../Images/pic.png" >
                    <p class="caption"> Lorem ipsum dolor sit amet consectetur adipisicing elit.
                         Similique aut eaque sapiente molestiae voluptatum mollitia cupiditate voluptate?
                          At similique excepturi quas repellendus nihil deleniti voluptatem blanditiis!
                           Officiis quibusdam ducimus iure. </p>
                </div>
                <div class="col-sm-3">
                    <img class="img-thumbnail" src="../Images/pic.png">
                    <p class="caption">  Lorem ipsum dolor sit amet consectetur adipisicing elit.
                         Cum ipsa ab nihil officia aspernatur quos illo dicta reiciendis sint? 
                         Pariatur ipsa esse quia iste ad mollitia harum expedita, optio inventore. </p>
                </div>
                <div class="col-sm-3">
                    <img class="img-thumbnail" src="../Images/pic.png">
                    <p class="caption">  Lorem ipsum dolor sit amet consectetur adipisicing elit.
                         Cum ipsa ab nihil officia aspernatur quos illo dicta reiciendis sint? 
                         Pariatur ipsa esse quia iste ad mollitia harum expedita, optio inventore. </p>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>

<?php include '../footer.html' ?>