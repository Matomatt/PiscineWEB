<?php
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


    if(!empty($_POST['bouton1']))
    {
        if(!empty($_POST["prenom"]) && !empty($_POST['nom']) &&!empty($_POST['email']) && !empty($_POST['mdp']) &&! empty($_POST['mdpverif']) && !empty($_POST['tel']) 
        && !empty($_POST['adresse']) && !empty($_POST['ville']) && !empty($_POST['cp']) && !empty($_POST['pays']))
         {
        if($db_found)
        {
                $sql = " SELECT * FROM acheteurs ";

                if(!empty($_POST['email']))
                {
                    echo "email != NULL";
                    $sql .= " WHERE `Email` = '$email' ";
                    echo "<br>";                }
                else{ echo "marche pas ";}

                $result = mysqli_query($db_handle, $sql);

            
                $num = mysqli_num_rows($result);
                echo "num == $num";
            
            if (mysqli_num_rows($result)!=0)
            {
                echo "Cette adresse e-mail est déjà enregistrée";
                echo "<br>";
                echo "<a href=\"creercompte.html\"> Revenir en arrière" ;
                echo "<br>";
            }
            else
            {
                if( ($mdp) == ($mdpverif))
                {
                    $sql = "INSERT INTO acheteurs (Email, Password, Nom, Prenom, Telephone) 
                        VALUES  ('$email','$mdp','$nom','$prenom','$tel')";

                    $result = mysqli_query($db_handle, $sql); 

                    if($result)
                        {
                            echo "Add successful 1. <br>";
                            $sqladresse =" INSERT INTO adresses (Nom, Adresse_ligne_1 , Adresse_ligne_2, Ville, Code_postale, Pays, Telephone) 
                            VALUES  ('$nom', '$adresse', '$cpltadresse', '$ville' , '$cp' , '$pays' , '$tel')";



                            $result2 = mysqli_query($db_handle, $sqladresse); 

                            if($result2)
                            {

                                $trouverID = "SELECT MAX(ID) FROM adresses";
                                echo "trouver iD = . $trouverID .";
                               
                                $sqlupdate = "UPDATE acheteurs SET ID_Adresse = '$trouverID'";

                                $sqlupd = "UPDATE acheteurs A set ID_Adresse = (SELECT max(id) from adresses) where A.Email ='$email' ";
                               //$sqlupd = "SELECT ID FROM adresses LEFT JOIN acheteurs ON adresses.ID=acheteurs.ID_Adresse WHERE (adresses.Telephone = $tel AND adresses.Nom = $nom) ";
                                $result3 = mysqli_query($db_handle, $sqlupd);
                                if ($result3)
                                {echo "ça marche !! ";}
                                else{echo "ça marche  PAS!! ";}
                            }
                            else{echo "erreur result 2";}

                        }
                    else
                    echo "Erreur: " . $sql . "<br>" . mysqli_error($db_handle);
                }
                else
                {
                    echo "Les deux mots de passe sont différents <br>";
                    echo "<a href=\"creercompte.html\"> Revenir en arrière" ;
                }
            }
        }
        else
        {echo "DB not found";
        echo "<br>";
        echo "<a href=\"creercompte.html\"> Revenir en arrière ";}

        }
        else 
        {
            echo "veuillez remplir tout les champs";
            echo "<br>";
            echo "<a href=\"creercompte.html\"> Revenir en arrière" ;
        }
    }

   

?>




