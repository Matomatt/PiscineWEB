<?php 
    if (isset($_GET["id"]))
    {
        session_start();
        if (!isset($_SESSION["UserID"]) || !isset($_SESSION["UserType"]))
        {
            die('<script>
                    alert("Veuillez vous connecter à votre compte");
                    window.location = "CreerCompte/connexion.php";
                </script>');
        }
        
        $UID = (isset($_SESSION["UserID"])?$_SESSION["UserID"]:"");
        
        $conn = new mysqli('localhost','root', '', 'ecebay');
        
        if ($conn->connect_error) { die('<script> alert("Database not found"); history.back(); </script>'); }
        
        $sql = "SELECT * FROM offres WHERE ID=" . $_GET["id"];
        
        if (!($offre=$conn->query($sql)))
            echo '<script> alert("Error: ' . $sql . ' ' . $conn->error . '"); </script>';
        
        $offre = $offre->fetch_assoc();
        
        if ($_SESSION["UserType"] == $offre["Instigateur"])
        {
            die('<script>
                alert("Veuillez vous connecter au bon compte");
                window.location = "CreerCompte/connexion.php";
            </script>');
        }
        
        $sql = "DELETE FROM offres WHERE ID_Item=" . $offre["ID_Item"] . " AND ID_Acheteur=" . $offre["ID_Acheteur"] . " AND ID <> " . $offre["ID"];
        
        if (!$conn->query($sql))
            echo 'Nothing has been deleted.<br>';
        
        $sql = "UPDATE `offres` SET `Accepted` = '1' WHERE `offres`.`ID` =" . $offre["ID"];
        
        if ($conn->query($sql))
        {
            $DejaDansLePanier = mysqli_query($conn, 'SELECT * FROM paniers WHERE ID_Item=' . $offre["ID_Item"] . ' AND ID_Acheteur=' . $offre["ID_Acheteur"]);
            $deja = 0;
            if ($DejaDansLePanier)
            {
                if (mysqli_num_rows($DejaDansLePanier) > 0)
                {
                    $DejaDansLePanier = $DejaDansLePanier->fetch_assoc();
                    echo '>' . $DejaDansLePanier["ID"] . '<';
                    $deja = ($DejaDansLePanier["ID"]!="")?1:0;
                    
                    //echo '<br> ' . date('Y-m-d h:i:s', strtotime($DejaDansLePanier["Date"]. ' + 1 days')) . ' < ' . date('Y-m-d h:i:s', time()) . '<br>';
                    if (date('Y-m-d h:i:s', strtotime($DejaDansLePanier["Date"]. ' + 1 days')) < date('Y-m-d h:i:s', time()) && $deja == 1)
                    {
                        //echo 'Dans le panier depuis plus de 24h ! Allez hop on remets aux enchères ! <br>';
                        $queryUpdate = "DELETE FROM offres WHERE ID=" . $offre["ID"];
                        $resultUpdate = mysqli_query($conn, $queryUpdate);
                        if (!$resultUpdate)
                            echo "Error updating... " . $queryUpdate . '<br>';
                        
                        $queryUpdate = "DELETE FROM paniers WHERE ID_Item=" . $offre["ID_Item"] . " AND ID_Acheteur=" . $offre["ID_Acheteur"];
                        $resultUpdate = mysqli_query($conn, $queryUpdate);
                        if (!$resultUpdate)
                            echo "Error updating... " . $queryUpdate . '<br>';
                    }
                }
            }
            if ($deja == 0)
            {
                $queryPanier = "INSERT INTO `paniers` (`ID_Acheteur`, `ID_Item`, `Quantite`) VALUES ('" . $offre["ID_Acheteur"] . "', '" . $offre["ID_Item"] . "', '1');";
                echo $queryPanier;
                $resultAddPanier = mysqli_query($conn, $queryPanier);
                if (!$resultAddPanier)
                    echo "Erreur ajout panier... " . $queryPanier . '<br>';
            }
        }
        else
            echo "Nothing has been accepted.<br>";
        
        $conn->close();
        echo '<script> window.location.href= "'.$_SESSION["UserType"].'/mon_compte.php?page=offres"; </script>';
    }
    else
        echo '<script> alert("Erreur"); window.location.href= "Accueil/index.php"; </script>';
?>

