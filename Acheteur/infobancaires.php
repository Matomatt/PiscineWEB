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

<div class=" col-lg-8 col-sm-3 col-xs-2 mx-auto" style="float:none; text-align: center;  ">
    <div class="row justify-content-center" style="float:none ">
        <div class="solde col-lg-4" style="border-style: groove;">
            <p><strong>Solde :</strong></p>
            <p>
                Le résultat de vos ventes sera transféré ici
            </p>
            <p>
                Dernières Activitées
            </p>
            <p>
                Chaine Hifi +40Euros
            </p>
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
                    <button style="width: auto;" onClick="valPaypal()">Ajouter</button>

                </form>
            </div>
            <div id="affichagePaypal" style="display:none;"> 
                <p>adresse@email.fr</p>
                <p>Solde</p>
            </div>
        </div>

    </div>
    <br>

    <div class="row  mx-auto col-lg-8 justify-content-center" style="float:none; border-style: groove;">
        <div class="carte">
            <p><strong> BANCAIRES</strong></p><br>
            <button class="col-lg-9 col-xs-3" onClick="addcarte()">Ajouter une carte de payement</button>
            <br>

            <div id="formCarte" style="display:none; ">
                <form>
                    <div class="form-group">
                        <input type="text"  placeholder="Nom du titulaire" name="nomCarte" />
                    </div>
                    <div class="form-group">
                        <input type="number" placeholder="Numero" name="numeroCarte" />
                    </div>
                    <div class="form-group">
                        <p>Date d'expiration : </p>
                        <input type="month"  placeholder="Date d'expiration" name="dateCarte" />
                    </div>
                    <div class="form-group">
                        <input type="number"  placeholder="Cryptogramme" name="cryptoCarte" />
                    </div>
                    <input type="submit" value="Ajouter">
                </form>
            </div>

            <div class="listeCartes">
                <table type="table">
                    <tr>
                        <td><img src="#"></td>
                        <td>Type Carte</td>
                        <td>xxxx-xxxx-xxxx-0000</td>
                        <td>Date expiration</td>
                    </tr>
                    <tr>
                        <td><img src="#"></td>
                        <td>Type Carte</td>
                        <td>xxxx-xxxx-xxxx-0000</td>
                        <td>Date expiration</td>
                    </tr>
                </table>

            </div>
        </div>

        
    </div>
    
</div>
<!--  
        
-->

