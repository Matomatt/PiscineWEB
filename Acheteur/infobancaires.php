
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


    </script>
</head>




    <div class="paypal col-lg-3" style="border-style: groove; float:left">
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
    
    <div class="col-lg-5 justify-content-center" style="float:none; border-style: groove; text-align:center; margin-left: 2em; float:left">
        <strong> CARTES BANCAIRES</strong><br>
        <button class="btn btn-light col-lg-9 col-xs-3" onClick="addcarte()" style="margin-bottom: 1em">Ajouter une carte de payement</button>
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
                    <input type="number" min="1" max="12" placeholder="Mois" name="moisCarte" />
    
                </div>
                <div class="form-group">
                    <input type="text"  placeholder="Cryptogramme" name="cryptoCarte" />
                </div>
                <input type="submit" value="Ajouter" name="ajoutercarte" style="margin-bottom: 1em">
            </form>
        </div>
    
    
    
    	<table type="table" border=1 frame=above rules=rows>
    	
        <?php
            $id=(isset($_SESSION["UserID"])?$_SESSION["UserID"]:"");
        
        
            $sql = "SELECT * FROM carte_bancaires WHERE ID_Acheteur ='$id'";
            $results = mysqli_query($db_handle, $sql);
    
            while($row = mysqli_fetch_array($results)) {
              echo '<tr> <td>' . 
                    $row['Nom'] . '<br>';
                    $cardX = str_split($row['Numero'], 4); 
              echo "XXXX-XXXX-XXXX-", $cardX[3] . '<br>
                    Date d\'expiration : ' .$row['Mois_exp']. '/' .$row['Annee_exp'] . '<br>
                   </td> </tr>';
            } ?>
            
    	</table>
    </div>