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
                // Si le mot de passe et l'identifiant ne correspondent pas
                die('<script>
                            alert("Mot de passe ou identifiant incorect");
            				window.location = "../CreerCompte/connexion.html";
            			  </script>');
            } else {
                die('<script>
            				window.location = "../Acheteur/compteclient.html";
            			  </script>');
            }
        } else {
            die('<script>
                    alert("Veuillez remplir tous les champs");
    				window.location = "../CreerCompte/connexion.html";
    			  </script>');
        }
    } else {
        die('<script>
                alert("Database not found !");
				window.location = "../CreerCompte/connexion.html";
			  </script>');
    }
}
?>
