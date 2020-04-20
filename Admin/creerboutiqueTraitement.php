<?php
    
    //Récupérer les données venant de creerboutique.html
    $nomboutique = isset($_POST["nomboutique"])? $_POST["nomboutique"] : "";
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


    //identifier la BDD
    $database = "ecebay";

    // se connecter à la BDD
    $db_handle = mysqli_connect('localhost', 'root', '');
    $db_found = mysqli_select_db($db_handle, $database);

    //si le bouton a été sollicité sur la page HTML
    if(!empty($_POST['bouton1']))
    {
        //Si tout les champs sont remplis
        if(  !empty($_POST["prenom"]) && !empty($_POST['nom']) &&!empty($_POST['email']) && !empty($_POST['mdp']) &&! empty($_POST['mdpverif']) && !empty($_POST['tel']) 
        && !empty($_POST['adresse']) && !empty($_POST['ville']) && !empty($_POST['cp']) && !empty($_POST['pays']))
         {

        //Si la base de donnée est trouvée
        if($db_found)
        {
                $sql = " SELECT * FROM vendeurs ";

                //Rechercher parmis les emails vendeurs de la DBB celle entrée n'existe pas déjà
                if(!empty($_POST['email']))
                {
                    $sql .= " WHERE `Email` = '$email' ";
                   }
                else
                {
                    die('<script>
                    alert("le champs Email n a pas été remplis");
                    window.location = "../CreerCompte/creerboutique.html";
                    </script>') ;
                }

                $result = mysqli_query($db_handle, $sql);
            
            //Verifier si l'adresse email existe deja dans la BDD
            if (mysqli_num_rows($result)!=0)
            {
               die('<script>
               alert("Cette adresse e-mail est déjà utilisée");
               window.location = "../CreerCompte/creerboutique.html";
               </script>') ;
            }
            else
            {   // verifier si le mot de passe et le mot de passe de verification sont les mêmes
                if( ($mdp) == ($mdpverif))
                {   
                    //ajouter a la base de donnée les infos rentrées
                    $ID_Solde = "";
                    if (mysqli_query($db_handle, "INSERT INTO `soldes` (`Montant`) VALUES ('0');"))
                        $ID_Solde = mysqli_query($db_handle, "SELECT LAST_INSERT_ID() as lastID FROM soldes")->fetch_assoc()["lastID"];
                    
                    $sql = "INSERT INTO vendeurs (Email, Password, Nom, Prenom, Boutique, ID_Solde, Telephone) 
                        VALUES  ('$email','$mdp','$nom','$prenom','$nomboutique', '$ID_Solde', '$tel')";
                    echo $sql;

                    $result = mysqli_query($db_handle, $sql);
                    

                    if($result)
                        {
                            //inserer dans adresse
                            $sqladresse =" INSERT INTO adresses (Nom, Adresse_ligne_1 , Adresse_ligne_2, Ville, Code_postale, Pays, Telephone) 
                            VALUES  ('$nom', '$adresse', '$cpltadresse', '$ville' , '$cp' , '$pays' , '$tel')";

                            $result2 = mysqli_query($db_handle, $sqladresse); 

                            // relier le ID de la table adresse à ID_Adresse de la table vendeurs
                            if($result2)
                            {
                                $sqlupd = "UPDATE vendeurs A set ID_Adresse = (SELECT ID FROM adresses WHERE ID=LAST_INSERT_ID()) WHERE A.Email ='$email' ";
                                $result3 = mysqli_query($db_handle, $sqlupd);

                                echo $sqlupd;
                                
                                if (!$result3)
                                   die('<script> alert("Une erreur s est produite"); window.location = "../Admin/creerboutique.html"; </script>') ;
                            }
                            else{
                                die('<script>
                                alert("Une erreur s est produite");
                                window.location = "../Admin/creerboutique.html";
                                </script>') ;}

                        }
                    else
                    {
                        die('<script>
                            alert("N\'a pas été ajouté dans la base de donnée");
                            window.location = "../Admin/creerboutique.html";
                        </script>') ;
                     //echo "Erreur: " . $sql . "<br>" . mysqli_error($db_handle);

                    }
                }
                //si mdp et mdpverif ne sont pas pareils
                else
                {
                    die('<script>
                    alert("Les deux mots de passe ne correspondent pas");
                    window.location = "../Admin/creerboutique.html";
                    </script>') ;
                }
            }
        }
        //si la base de donnée n'est pas trouvée
        else
        {die('<script>
            alert("Base de donnée introuvable");
            window.location = "../Admin/creerboutique.html";
            </script>');}

        }
        //Si tout les champs ne sont pas remplis
        else 
        {
            die('<script>
                        alert("Veuillez remplir tous les champs");
        				window.location = "../Admin/creerboutique.html";
        		</script>');
        }
    }

    echo '<script> window.location = "../Admin/mon_compte.php?page=vendeurs"; </script>';

?>
