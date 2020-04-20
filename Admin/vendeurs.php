<div class="container-fluid" style="text-align: center">
	<a href="../Admin/creerboutique.html">Ajouter un vendeur</a>
	<hr>
    <table border=1 frame=void rules=rows>
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
        
        if ($_SESSION["UserType"] != "Admin")
        {
            die('<script>
                    window.location = "../CreerCompte/connexion.php";
                </script>');
        }
    
        $ID=(isset($_SESSION["UserID"])?$_SESSION["UserID"]:"");
    
        $query = "SELECT * FROM vendeurs ORDER BY ID DESC";
        $result = mysqli_query($db_handle, $query);
    
        if (!$result)
        {
            die('Couldn\'t find table');
        }
    
        while($row = $result->fetch_assoc()) 
        { ?>
            <tr>
            	<td><?php echo $row["ID"]; ?></td>
            	<td><?php echo $row["Nom"]; ?></td>
            	<td><?php echo $row["Prenom"]; ?></td>
            	<td><?php echo $row["Email"]; ?></td>
            	<td><?php echo $row["Boutique"]; ?></td>
            	<td><a href="../Admin/delete.php?id=<?php echo $row["ID"]; ?>">Supprimer</a></td>
            </tr>
       <?php } ?>
    
    </table>
</div>