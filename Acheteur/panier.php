
<?php
    include '../header.php';
?>

<!DOCTYPE html>
<!-- sources :
    w3schools.com/html/html_tables.asp :table rowspan
-->
<html>
    <head >
        <meta charset= "utf-8">
        <meta name= "viewport" content= "width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="style.css">

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

    <body>           

        <div class="container-fluid">
            <table>
                <tr>
                    <th>Mon panier</th>
                </tr>
                <tr>
                    <td><img src="../Images/pic.png" style="width:100px;"></td>
                    <td>
                        <p class="nomproduit"><strong>Nom produit : </strong></p>
                        <p class="description">Description Produit : </p>
                    </td>
                    <td><p class="prix">Prix Unitaire : </p></td>
                    <td><p class="quantite">Quantité : </p></td>
                    <td><p class="prix">Prix : </p></td>
                    <td><button>Supprimer</button></td>
                </tr>
                <tr>
                    <td><img src="../Images/pic.png" style="width:100px;"></td>
                    <td>
                        <p class="nomproduit"><strong>Nom produit : </strong></p>
                        <p class="description">Description Produit : </p>
                    </td>
                    <td><p class="prix">Prix Unitaire : </p></td>
                    <td><p class="quantite">Quantité : </p></td>
                    <td><p class="prix">Prix : </p></td>
                    <td><button>Supprimer</button></td>
                </tr>
                <tr>
                    <th rowspan="5">Prix Total</th>
                    <td>...euros</td>
                </tr>
                <tr>
                    <td>...Frais de ports</td>
                </tr>
                <tr>
                    <td>...total euros</td>
                </tr>
                <tr>
                    <td><button>Poursuivre mes achats</button></td>
                </tr>
                <tr>
                    <td><button>Finaliser la commande</button></td>
                </tr>
            </table>
        </div>
    </body>
</html>


