<?php
    echo "Trying to connect to the database <br>";

    $host = 'localhost';
    $user = 'root';
    $password = ''; //To be completed if you have set a password to root
    $database = 'tpnote2'; //To be completed to connect to a database. The database must exist.

    $db_handle = mysqli_connect($host, $user, $password);
    $db_found = mysqli_select_db($db_handle, $database);

    if (!$db_found) { die('Database not found'); }

    echo 'Connected ! <br>';

	$query = "SELECT * FROM employes WHERE SUBSTRING(Prenom, 1, 1) = 'G';";
    $result = mysqli_query($db_handle, $query);

    if (!$result)
    {
       echo 'Couldn\'t find table';
       return;
    }

    echo 'Table found ! <br>';
    
	if (mysqli_num_rows($result) < 1)
	{
		echo "Empty";
		return;
	}

    echo mysqli_num_rows($result) . ' rows <br>';
    
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["ID"]. " - Name: " . $row["Nom"]. " " . $row["Prenom"]. " " . $row["Statut"] . " born on " . $row["DateNaissance"] . "<br>";
    }
?>