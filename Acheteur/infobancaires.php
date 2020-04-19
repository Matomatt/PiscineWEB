
<head>
	<script>
        function addpaypal ()
        {
            var div = document.getElementById("formPaypal");
            if(div.style.display === 'none'){
                div.style.display = 'block';
            }
            else
            {div.style.display = 'none';}
        }
        function addcarte ()
        {
            var div = document.getElementById("formCarte");
            if(div.style.display === 'none'){
                div.style.display = 'block';
            }
            else
            {div.style.display = 'none';}
        }

        function valPaypal()
        {
            var div=document.getElementById("affichagePaypal");
            var div2=document.getElementById("formPaypal");
            if(div.style.display === 'none'){
                div.style.display = 'block';
                div2.style.display ='none';
            }
            else
            {div.style.display = 'none';
            div2.style.display ='block';}
        }
    </script>
</head>





<div class=" col-lg-4 col-sm-3 col-xs-2 mx-auto" style="float:none; text-align: center;  ">
    <div class="row justify-content-center" style="float:none ">
       
            
        <div class="paypal col-lg-4" style="border-style: groove; vertical-align: middle;">
            <p><strong>PAYPAL</strong></p>
            <button style="width: auto;" onClick="addpaypal()">Ajouter un compte Paypal</button>
            <div id="formPaypal" style="display:none;">
                <form action="infobancairesTraitement.php" method="POST">
                    <div class="form-group">
                        <input type="email"  placeholder="e-mail" name="emailPaypal" />
                    </div>
                    <div class="form-group">
                        <input type="password"  placeholder="mot de passe" name="mdpPaypal" />
                    </div>
                    <input type="submit" value="Ajouter" name="addpaypal">

                </form>
            </div>


	<?php
        $id=(isset($_SESSION["UserID"])?$_SESSION["UserID"]:"");
        $sql = "SELECT * FROM paypal_accounts WHERE ID_Proprietaire ='$id'";
        $results = mysqli_query($db_handle, $sql);
    
        while($row = mysqli_fetch_array($results)) {
            echo '<p >'. $row['Email'] . '</p>
                  <p>'.  $row['Montant']. 'euros</p>';
            } 
    ?>
    </div>
    <br>

    <div class="row  mx-auto col-lg-8 justify-content-center" style="float:none; border-style: groove;">
        <div class="carte">
            <p><strong> BANCAIRES</strong></p><br>
            <button class="col-lg-9 col-xs-3" onClick="addcarte()">Ajouter une carte de payement</button>
            <br>

            <div id="formCarte" style="display:none; ">
                <form action="infobancairesTraitement.php" method="POST">
                    <div class="form-group">
                        <input type="text"  placeholder="Nom du titulaire" name="nomCarte" />
                    </div>
                    <div class="form-group">
                        <input type="number" placeholder="Numero" name="numeroCarte" />
                    </div>
                    <div class="form-group">
                        <p>Date d'expiration : </p>
                        <input type="number" min="2020" max="2040" placeholder="Annee" name="anneeCarte" />
                        <input type="number" max="12" placeholder="Mois" name="moisCarte" />

                    </div>
                    <div class="form-group">
                        <input type="text"  placeholder="Cryptogramme" name="cryptoCarte" />
                    </div>
                    <input type="submit" value="Ajouter" name="ajoutercarte">
                </form>
            </div>

            <div class="listeCartes col-lg-8">


    <table type="table">

<?php
    $id=(isset($_SESSION["UserID"])?$_SESSION["UserID"]:"");


    $sql = "SELECT * FROM carte_bancaires WHERE ID_Acheteur ='$id'";
    $results = mysqli_query($db_handle, $sql);

            while($row = mysqli_fetch_array($results)) {
            ?>
                <tr>
                    <td><?php echo "Nom : ", $row['Nom']?></td>
                </tr>
                <tr>
                    <td><?php $OriginalString = $row['Date_Expiration'];
                        $cardX = str_split($row['Numero'], 4); 
                        echo "Numéros de carte : XXXX-XXXX-XXXX-", $cardX[3];?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php echo "Date d'expiration : " ,$row['Date_Expiration'] ?> 
                    </td>
                </tr>
            <?php } ?>
                </table>

            </div>
        </div>

        
    </div>
    
</div>