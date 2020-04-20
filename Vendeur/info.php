<?php
	      
	$ID_Vendeur=(isset($_SESSION["UserID"])?$_SESSION["UserID"]:"");

    $query = "SELECT * FROM vendeurs WHERE ID=".$ID_Vendeur."";
    $result = mysqli_query($db_handle, $query);

        if (!$result)
        {
            die('Couldn\'t find table');
        }

        $row = $result->fetch_assoc();

        echo '<div class="Container" style="margin-left : 5em;">
        	<table style="border: 1px solid black; border-collapse: collapse;">
        		<tr>
					<th><a href="../Vendeur/modifDebInfo.php">Modifier</a></th>
				</tr>
				<tr>
					<td>Nom : </td>
					<td class="tdText">'.$row["Nom"].'</td>
				</tr>
				<tr>
					<td>Prénom : </td>
					<td class="tdText">'.$row["Prenom"].'</td>
				</tr>
				<tr>
					<td>Boutique : </td>
					<td class="tdText">'.$row["Boutique"].'</td>
				</tr>
				<tr>
					<td>Adresse mail : </td>
					<td class="tdText">'.$row["Email"].'</td>
				</tr>
				<tr>
					<td>Télephone : </td>
					<td class="tdText">'.$row["Telephone"].'</td>
				</tr>
			</table>
		</div>';
    ?>	