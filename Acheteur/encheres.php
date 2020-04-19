<!DOCTYPE html>

<html>
<head >
	<title>Mes enchères - ECEbay</title>

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
    <div class="container-fluid" >
    <?php include '../header.php'; ?>
        <div class="row" >
            <div class="leftnavbartop col-lg-2 col-sm-4 col-xs-3">
                <a><img class="rounded-circle" src="../Images/avatar.jpg" style="max-width: 50%;"></a>
                <br>
                <a style="color: #fff; ">Mon nom</a>
                 
            </div>

            <div class="topright col-lg-5 mx-auto"  style=float:none>
                MES ENCHERES
            </div>
        </div>
    
        <div class="row">
            <div class="leftnavbar col-lg-2 col-sm-4 col-xs-3">
                
             <!-- Mettre les liens-->
             <a href="compteclient.html"> TABLEAU DE BORD</a>
             <a href="info.html">Informations personelles</a>
             <hr  color="grey" ">
             <a href="#">Informations bancaires</a>
             <hr color="grey" ">
             <a href="historique.html">Historique des achats</a>
             <hr color="grey" ">
             <a href="encheres">Enchères en cours</a>
             <hr color="grey" ">
             <a href="#">Les offres</a>
             <hr color="grey" ">
             <a href="#">Mes paramètres</a>
    
            </div>
    
        <div class="histo-achat col-lg-8 col-sm-3 col-xs-2 mx-auto" style=float:none;>      
          
         <div class="achatpasse">
             <h3>Mes enchères en cours </h3>
            <table type="table" >
                <tr style="text-align: justify;">
                    <td>
                         <img src="../Images/pic.png" style="max-width: auto;">
                    </td>
                       <td style="padding: 5px; padding-right: 15px;">
                           <p class="nomproduit"><strong>Nom produit</strong></p>
                           <p class="description">Description Produit Lorem ipsum dolor sit amet consectetur adipisicing elit.
                            Fuga et veritatis voluptas reprehenderit iste iusto ducimus! </p>
                       </td>
                      <td>
                         <p class="prix">Prix enchéri</p>
                    </td>
                    <td>
                        <p class="prix">Enchère actuelle</p>
                   </td>
                   <td>
                    <p class="temps">Temps restant</p>
                 </td>

                </tr>
                    
                <table type="table" >
                    <tr style="text-align: justify;">
                        <td>
                             <img src="../Images/pic.png" style="max-width: auto;">
                        </td>
                           <td style="padding: 5px; padding-right: 15px;">
                               <p class="nomproduit"><strong>Nom produit</strong></p>
                               <p class="description">Description Produit Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                Fuga et veritatis voluptas reprehenderit iste iusto ducimus! </p>
                           </td>
                          <td>
                             <p class="prix">Prix enchéri</p>
                        </td>
                        <td>
                            <p class="prix">Enchère actuelle</p>
                       </td>
                       <td>
                        <p class="temps">Temps restant</p>
                     </td>
    
                    </tr>
            </table>
        </div>
        
     </div>
        
    <br>
    
    </div>

</body>
</html>


