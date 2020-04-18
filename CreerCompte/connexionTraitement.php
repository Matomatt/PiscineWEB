<?php
    // recuperer les données venant de la page HTML
    $email = isset($_POST["email"]) ? $_POST["email"] : "";
    $mdp = isset($_POST["mdp"]) ? $_POST["mdp"] : "";
    
    // identifier votre BDD
    $database = "ecebay";
    
    // se connecter à la BDD
    $db_handle = mysqli_connect('localhost', 'root', '');
    $db_found = mysqli_select_db($db_handle, $database);
    
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
                            // Si le mot de passe et l'identifiant ne correspondent pas a un admin
                            die('<script>
                                alert("Mot de passe ou identifiant incorect");
                				window.location = "../CreerCompte/connexion.html";
                			 </script>');
                        } else {
                            session_start();
                            $ID_Admin = $result->fetch_assoc()["ID"];
                            $_SESSION['UserID'] = $ID_Admin;
                            $_SESSION['UserType'] = "Admin";
                            die('<script>
                				window.location = "../Admin/compteadmin.html";
                			  </script>');
                        }
                        
                        
                        // Si le mot de passe et l'identifiant ne correspondent pas a un vendeur
                        die('<script>
                                alert("Mot de passe ou identifiant incorect");
                				window.location = "../CreerCompte/connexion.html";
                			 </script>');
                    } else {
                        session_start();
                        $ID_Vendeur = $result->fetch_assoc()["ID"];
                        $_SESSION['UserID'] = $ID_Vendeur;
                        $_SESSION['UserType'] = "Vendeur";
                        die('<script>
                				window.location = "../Vendeur/comptevendeur.php";
                			  </script>');
                    }
                    
                    // Si le mot de passe et l'identifiant ne correspondent pas à un acheteur
                    die('<script>
                                alert("Mot de passe ou identifiant incorect");
                				window.location = "../CreerCompte/connexion.html";
                			  </script>');
                } else {
                    session_start();
                    $ID_Acheteur = $result->fetch_assoc()["ID"];
                    $_SESSION['UserID'] = $ID_Acheteur;
                    $_SESSION['UserType'] = "Acheteur";
                    die('<script>
                				window.location = "../Acheteur/compteclient.php";
                			  </script>');
                }
            } else {
                die('<script>
                        alert("Veuillez remplir tous les champs");
        				window.location = "../CreerCompte/connexion.php";
        			  </script>');
            }
        } else {
            die('<script>
                    alert("Database not found !");
    				window.location = "../CreerCompte/connexion.php";
    			  </script>');
        }
    }
?>
