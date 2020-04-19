<?php
    //Récupérer les données venant de creercompte.php

    $prenom = isset($_POST["prenom"])? $_POST["prenom"] : "";
    $nom = isset($_POST["nom"])? $_POST["nom"] : "";
    $email = isset($_POST["email"])? $_POST["email"] : "";
    $mdp = isset($_POST["mdp"])? $_POST["mdp"] : "";
    $mdpverif = isset($_POST["mdpverif"])? $_POST["mdpverif"] : "";
    $tel = isset($_POST["tel"])? $_POST["tel"] : "";
    $adresse = isset($_POST["adresse"])? $_POST["adresse"] : "";
    $cpltadresse = isset($_POST["cpltadresse"])? $_POST["cpltadresse"] : "";
    $ville = isset($_POST["ville"])? $_POST["ville"] : "";
    $cp = isset($_POST["cp"])? $_POST["cp"] : "";
    $pays = isset($_POST["pays"])? $_POST["pays"] : "";


    //identifier votre BDD
    $database = "ecebay";

    // se connecter à la BDD
    $db_handle = mysqli_connect('localhost', 'root', '');
    $db_found = mysqli_select_db($db_handle, $database);

    //si le bouton a été sollicité sur la page HTML
    if(!empty($_POST['bouton1']))
    {
        //Si tout les champs sont remplis
        if(!empty($_POST["prenom"]) && !empty($_POST['nom']) &&!empty($_POST['email']) && !empty($_POST['mdp']) &&! empty($_POST['mdpverif']) && !empty($_POST['tel']) 
        && !empty($_POST['adresse']) && !empty($_POST['ville']) && !empty($_POST['cp']) && !empty($_POST['pays']))
         {

        //Si la base de donnée est trouvée
        if($db_found)
        {
                $sql = " SELECT * FROM acheteurs ";

                //Rechercher parmis les emails acheteurs de la DBB celle entrée n'existe pas déjà
                if(!empty($_POST['email']))
                {
                    
                    $sql .= " WHERE `Email` = '$email' ";
                }
                else
                { 
                    die('<script>
                    alert("le champs Email n a pas été remplis");
                    window.location = "../CreerCompte/creercompte.html";
                    </script>') ;
                }

                $result = mysqli_query($db_handle, $sql);

            
            //Verifier si l'adresse email existe deja dans la BDD
            if (mysqli_num_rows($result)!=0)
            {
                die('<script>
               alert("Cette adresse e-mail est déjà utilisée");
               window.location = "../CreerCompte/creercompte.html";
               </script>') ;
            }
            else
            {// verifier si le mot de passe et le mot de passe de verification sont les mêmes
                if( ($mdp) == ($mdpverif))
                {//ajouter a la base de donnée les infos rentrées
                    $sql = "INSERT INTO acheteurs (Email, Password, Nom, Prenom, Telephone) 
                        VALUES  ('$email','$mdp','$nom','$prenom','$tel')";
                    
                    echo $sql;

                    $result = mysqli_query($db_handle, $sql); 

                    if($result)
                    {
                        // inserer dans la table adresse
                        $sqladresse =" INSERT INTO adresses (Nom, Adresse_ligne_1 , Adresse_ligne_2, Ville, Code_postale, Pays, Telephone) 
                        VALUES  ('$nom', '$adresse', '$cpltadresse', '$ville' , '$cp' , '$pays' , '$tel')";

                        $result2 = mysqli_query($db_handle, $sqladresse); 

                        // relier le ID de la table adresse à ID_Adresse de la table acheteurs
                        if($result2)
                        {

                            $trouverID = "SELECT MAX(ID) FROM adresses";
                            echo "trouver iD = . $trouverID .";
                           
                            $sqlupdate = "UPDATE acheteurs SET ID_Adresse = '$trouverID'";

                            $sqlupd = "UPDATE acheteurs A set ID_Adresse = (SELECT max(id) from adresses) where A.Email ='$email' ";
                           //$sqlupd = "SELECT ID FROM adresses LEFT JOIN acheteurs ON adresses.ID=acheteurs.ID_Adresse WHERE (adresses.Telephone = $tel AND adresses.Nom = $nom) ";
                            $result3 = mysqli_query($db_handle, $sqlupd);
                            if ($result3)
                            {
                                session_start();
                                $sqlid = "SELECT ID FROM acheteurs WHERE Email ='$email';";
                                $result4 = mysqli_query($db_handle, $sqlid);
                                if ($result4)
                                {
                                    $ID_Acheteur = $result4->fetch_assoc()["ID"];
                                    $_SESSION['UserID'] = $ID_Acheteur;
                                    $_SESSION['UserType'] = "Acheteur";
                                }
                                die('<script>
                				        window.location = "../Acheteur/mon_compte.php";
                			         </script>');
                            }
                            else {
                                die('<script> alert("Une erreur s\'est produite"); window.location = "../CreerCompte/creercompte.html";  </script>') ;
                            }
                        }
                        else{die('<script>
                            alert("Une erreur s\'est produite");
                            window.location = "../CreerCompte/creercompte.html";
                            </script>') ;}

                    }
                    else
                    {
                        //die('<script> alert("N\'a pas été ajouté dans la base de donnée"); window.location = "../CreerCompte/creercompte.html"; </script>') ;
                        //echo "Erreur: " . $sql . "<br>" . mysqli_error($db_handle);
                    }
                }

                 //si mdp et mdpverif ne sont pas pareils
                else
                {
                    die('<script>
                    alert("Les deux mots de passe ne correspondent pas");
                    window.location = "../CreerCompte/creercompte.html";
                    </script>') ;
                }
            }
        }
        //si la base de donnée n'est pas trouvée
        else
        {die('<script>
            alert("Base de donnée introuvable");
            window.location = "../CreerCompte/creercompte.html";
            </script>');}

        }
        //Si tout les champs ne sont pas remplis
        else 
        {
            die('<script>
                alert("Veuillez remplir tous les champs");
        		window.location = "../CreerCompte/creercompte.html";
        		</script>');
        }
    }

   

?>




