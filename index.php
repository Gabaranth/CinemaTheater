<?php

require_once 'controller.php';

try{
    // Page d'accueil
    if (!isset($_GET["action"])) {
        
        vue_acceuil();

    } else if (isset($_GET["action"])) {
        
        // Page d'authentification administrateur avec vérification des inputs
        if ($_GET["action"] == "connexion") {
            
            if (isset($_POST["email"]) || isset($_POST["password"])) {
                
                $erreurs = control_form_fields_connexion($_POST["email"], $_POST["password"]);

            } else {
                
                vue_connexion();
            }

            if (!empty($erreurs)) {
                
                vue_connexion();

            } else {
                
                if (isset($_POST["email"]) && isset($_POST["password"])) {
                    
                    vue_back_office($_POST["email"], $_POST["password"]);
                }
            }
        }

        // Page d'accés pour la recherche des films avec la consommation de l'API TMDB et contrôle de l'input recherche
        if ($_GET["action"] == "web") {
            
            vue_recherche_film();
        }

        if ($_GET["action"] == "recherche") {

            if (isset($_POST["recherche"])) {
                
                $erreurs = control_form_fields_recherche($_POST["recherche"]);
            } else {

                vue_recherche_film();
            }

            if (!empty($erreurs)) {
                
                vue_recherche_film();
            } else {
                
                if (isset($_POST["recherche"])) {
                    
                    recherche_film($_POST["recherche"]);
                }
            }
        }

        // Page d'accés pour le formulaire d'ajout du film rechercher 
        if ($_GET["action"] == "ajout") {

            appelerWebServiceID($_GET["id"]);
            vue_formulaire_ajout();
            
        }

        // Action pour la vérification des inputs est des données envoyer pour stocker le film dans la base de données 
        if ($_GET["action"] == "bdd") {

            if (isset($_POST["affiche"]) || isset($_POST["category"]) || isset($_POST["pitch"])) {
                
                control_form_fields_ajout($_POST["affiche"], $_POST["category"], $_POST["pitch"]);
            } else {

                vue_formulaire_ajout();
            }

            if (!empty($erreurs)) {
                
                vue_formulaire_ajout();
            } else {

                ajouter_film_bdd($_POST["titre"], $_POST["year"], $_POST["affiche"], $_POST["category"], $_POST["pitch"]);
            }    
        }

        if ($_GET["action"] == "liste") {
            
            vue_liste_film();
        }
    } else {
        throw new Exception("<h1>Page non trouvée !!!</h1>");
    }

}catch(Exception $e){

    $msgErreur = $e->getMessage();
    echo erreur($msgErreur);
}

?>