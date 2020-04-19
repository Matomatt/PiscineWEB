

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





<div class=" col-lg-4 col-sm-3 col-xs-2 mx-auto" style="float:none; text-align: center;  ">
    <div class="row justify-content-center" style="float:none ">
        <div class="solde col-lg-4" style="border-style: groove;">
        <p><strong>Solde :</strong></p>
            <p>
                Le résultat de vos ventes sera transféré ici
            </p>
            <p>
                Dernières Activitées
            </p>
        <?php 
            session_start();

            //identifier la BDD
            $database = "ecebay";

            // se connecter à la BDD
            $db_handle = mysqli_connect('localhost', 'root', '');
            $db_found = mysqli_select_db($db_handle, $database);
            $id=(isset($_SESSION["UserID"])?$_SESSION["UserID"]:"");

            $sql2= "SELECT Nom, Montant FROM items I, transactions T WHERE I.ID = T.ID_item AND I.ID_Vendeur = '$id'" ;
            $result = mysqli_query($db_handle, $sql2);
                
            while ($row = mysqli_fetch_array($result)){
        ?>
            
            <p>
                <strong><?php echo $row['Nom'];?></strong>
                <?php echo $row['Montant'] ;?> euros
            </p>
            <?php } ?>
        </div>
            
        <div class="paypal col-lg-4" style="border-style: groove; vertical-align: middle;">
            <p><strong>PAYPAL</strong></p>
            <button style="width: auto;" onClick="addpaypal()">Ajouter un compte Paypal</button>
            <div id="formPaypal" style="display:none;">
                <form>
                    <div class="form-group">
                        <input type="email"  placeholder="e-mail" name="emailPaypal" />
                    </div>
                    <div class="form-group">
                        <input type="password"  placeholder="mot de passe" name="mdpPaypal" />
                    </div>
                    <button style="width: auto;" id="addpaypal">Ajouter</button>

                </form>
            </div>
            <?php
    $sql = "SELECT * FROM paypal_accounts WHERE ID_Proprietaire ='$id'";
    $results = mysqli_query($db_handle, $sql);

            while($row = mysqli_fetch_array($results)) {
            ?>
            
                <p ><?php echo $row['Email'] ;?></p>
                <p> <?php echo $row['Montant'] ;?> euros</p>
            <?php } ?>
        </div>

    </div>
    <br>


    
</div>