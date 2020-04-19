<?php
    // recuperer les données venant de la page HTML
    $email = isset($_POST["email"]) ? $_POST["email"] : "";
    $mdp = isset($_POST["mdp"]) ? $_POST["mdp"] : "";
    
    // se connecter à la BDD
    $db_handle = mysqli_connect('localhost', 'root', '');
    $db_found = mysqli_select_db($db_handle, 'ecebay');
    
    $error = "";
    $path = "";
    $ID_Item = isset($_POST["ID_Item"])?$_POST["ID_Item"]:"";
    
    if (! empty($_POST['bouton'])) {
    
        if ($db_found) {
            if (! empty($_POST['email']) && ! empty($_POST['mdp'])) {
    
                $sql = " SELECT * FROM acheteurs WHERE Email = '$email' AND Password = '$mdp'";
                
                $result = mysqli_query($db_handle, $sql);
                // tester s'il y a de résultat
                if (mysqli_num_rows($result) == 0) {
                    
                    $sql = " SELECT * FROM vendeurs WHERE Email = '$email' AND Password = '$mdp'";
                    
                    $result = mysqli_query($db_handle, $sql);
                    // tester s'il y a de résultat
                    if (mysqli_num_rows($result) == 0) {
                        $sql = " SELECT * FROM admin WHERE Email = '$email' AND Password = '$mdp'";
                        
                        $result = mysqli_query($db_handle, $sql);
                        // tester s'il y a de résultat
                        if (mysqli_num_rows($result) == 0) {
                            // Si le mot de passe et l'identifiant ne correspondent a rien
                            $error = "Mot de passe ou identifiant incorect";
                            
                        } else {
                            session_start();
                            $ID_Admin = $result->fetch_assoc()["ID"];
                            $_SESSION['UserID'] = $ID_Admin;
                            $_SESSION['UserType'] = "Admin";
                            $path = "../Admin/compteadmin.html";
                        }
                        
                    } else {
                        session_start();
                        $ID_Vendeur = $result->fetch_assoc()["ID"];
                        $_SESSION['UserID'] = $ID_Vendeur;
                        $_SESSION['UserType'] = "Vendeur";
                        $path = "../Vendeur/mon_compte.php";
                    }
                    
                } else {
                    session_start();
                    $ID_Acheteur = $result->fetch_assoc()["ID"];
                    $_SESSION['UserID'] = $ID_Acheteur;
                    $_SESSION['UserType'] = "Acheteur";
                    $path = "../Acheteur/mon_compte.php";
                }
            } else {
                $error = "Veuillez remplir tous les champs";
            }
        } else {
            $error = "Database not found !";
        }
    }
    else
        $error = "Nothing has been sent...";
    
    if ($error != "" || $path == "" && $ID_Item == "") {
        echo '<script> alert("' . $error . '"); window.location = "../CreerCompte/connexion.php"; </script>';
    }
    else if ($ID_Item != ""){
        echo '<script> window.location.href= "../Produit/index.php?id=' . $ID_Item . '"; </script>';
    }
    else {
        echo '<script> window.location = "' . $path . '"; </script>';
    }
?>
