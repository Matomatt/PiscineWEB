<div class="offres col-lg-10 mx-auto"  style=float:none>
    <table class="table">
    
    <?php

        $db_handle = mysqli_connect('localhost', 'root', '');
        $db_found = mysqli_select_db($db_handle, 'ecebay');
    
        if (!$db_found) { die('Database not found'); }
    
        if (!isset($_SESSION["UserID"]) || !isset($_SESSION["UserType"]))
        {
            die('<script>
                    alert("Veuillez vous connecter à votre compte");
                    window.location = "../CreerCompte/connexion.php";
                </script>');
        }
        
        if ($_SESSION["UserType"] != "Vendeur")
        {
            die('<script>
                    alert("Veuillez vous connecter à votre compte Acheteur");
                    window.location = "../CreerCompte/connexion.php";
                </script>');
        }
    
        $ID_Vendeur = (isset($_SESSION["UserID"])?$_SESSION["UserID"]:"");
    
        $query = "SELECT * FROM offres WHERE ID_Item IN (SELECT ID FROM items WHERE ID_Vendeur=". $ID_Vendeur .") AND Accepted=0 ORDER BY Date DESC";
        $result = mysqli_query($db_handle, $query);
    
        if (!$result)
        {
            die('Couldn\'t find table');
        }
    
        while($row = $result->fetch_assoc()) 
        {
            $queryItem = "SELECT * FROM items WHERE ID=". $row["ID_Item"];
            $resultItem = mysqli_query($db_handle, $queryItem);
            
            if (!$resultItem)
            {
                die('Couldn\'t find table');
            }
            
            $item = $resultItem->fetch_assoc();
            $img = mysqli_query($db_handle, "SELECT File FROM medias WHERE ID_Item=" . $item["ID"] . " AND indx = 0;");
            $img = ($img?$img->fetch_assoc()["File"]:"blank.png"); ?>
            <tr style="text-align: justify;">
                <td>
                    <img onclick="location.href='../Produit/index.php?id=<?php echo $row["ID_Item"];?>'" src="../UploadedContent/<?php echo $img; ?>" style="max-width: 10em; max-height: 8em">
                </td>
                <td >
                <strong><?php echo $item["Nom"]; ?></strong><br>
                 Prix de base : <?php echo ($item["Prix"]!=""?$item["Prix"]:"aucun"); ?>€
                </td>
                <td>
                	<?php if ($row["Instigateur"] == "Vendeur") echo 'Tu as fait une offre à '; ?>
                    <?php $acheteur = mysqli_query($db_handle, "SELECT Nom, Prenom FROM acheteurs WHERE ID=" . $row["ID_Acheteur"]);
                          if($acheteur)
                          {
                              $acheteur = $acheteur->fetch_assoc();
                              echo $acheteur["Prenom"] . ' ' . $acheteur["Nom"];
                          } ?>
                      <?php if ($row["Instigateur"] == "Vendeur") echo 'de ';
                            else echo 'fait une offre à ';
                            
                            echo $row["Prix"]; ?>€
                </td>
            </tr>
            
            <tr>
            	<?php if ($row["Instigateur"] == "Acheteur") {?>
                <td>
                    <button class="button1 accept" onclick="location.href='../accepterOffre.php?id=<?php echo $row["ID"];?>'">Accepter</button>
                </td>
                <td>
                    <button class="button1 refuse" onclick="location.href='../refuserOffre.php?id=<?php echo $row["ID"];?>'">Refuser</button>
                </td>
                <td>
                    <form method="post" action="../contreOffre.php?id=<?php echo $row["ID"];?>"><input type="number" name="contreoffre" \><button class="button1" type="submit">Contre offre</button></form>
                </td>
                <?php } else {?>
            	<td colspan="5">
                    <div style="margin-bottom: 1em">Attente d'une réponse</div>
                </td>
                <?php }?>
            </tr>
            
       <?php } ?>
       
        
                

    </table>
</div>