<?php

//recuperer les données venant de la page HTML
$email = isset($_POST["email"])? $_POST["email"] : "";
$mdp = isset($_POST["mdp"])? $_POST["mdp"] : "";

//identifier votre BDD
$database = "ecebay";

// se connecter à la BDD
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);


if(!empty($_POST['bouton']))
{

    if ($db_found) {

        if (!empty($_POST['email']) && !empty($_POST['mdp'])) {

            $sql=" SELECT * FROM acheteurs WHERE Email = '$email' AND Password = '$mdp'";

                $result = mysqli_query($db_handle, $sql);
                //tester s'il y a de résultat
                if (mysqli_num_rows($result) == 0) {
                    //Si le mot de passe et l'identifiant ne correspondent pas
                    echo "Mot de passe ou identifiant incorect";
                    echo "<a href=\"connexion.html\"> Revenir en arrière";
                } 
                else {

                    echo "ok ";
                    echo "<a href=\"creerboutique.html\"> Cliquez ici";
                }
        }
        else 
        {
            echo 'Veuillez remplir tous les champs';
            echo "<a href=\"connexion.html\"> Revenir en arrière";
        }
    }
    else {
    echo "Database not found";
    }
}
?>
