<?php
require_once 'modele.php';

function vue_acceuil(){

    if (isset($_SESSION["user"])) {
        $_SESSION = array();
        session_destroy();
        require "templates/accueil.php";
    } else {
        require "templates/accueil.php";
    }

}

function vue_connexion(){

    session_start();

    $cookie_name = "ticket";
    $ticket = session_id().microtime().rand(0,9999999999);
    $ticket = hash('sha512',$ticket);
    setcookie($cookie_name, $ticket, time()+(60*5));
    $_SESSION['ticket'] = $ticket;

    require "templates/connexion.php";
}

function control_form_fields_connexion($email, $password){

    session_start();

    $erreurs = array();


    if ((!empty($email)) && (!empty($password))) {
        
        if (verif_email() === false) {
            
            $erreurs["email"] = "E-mail incorect ou inexistant !";        
        }
        
        if (verif_password() === false) {
            
            $erreurs["password"] = "Mot de passe incorect ou inexistant !";
        }
    } else {

        if (empty($email)) {
            $erreurs["email"] = "Veuillez saisir un e-mail !";
        }


        if (empty($password)) {
            $erreur["password"] = "Veuillez saisir votre mot de passe !";
        }
    }
    return $erreurs;
}

function vue_back_office($email, $password){

    session_start();

    if ($_COOKIE['ticket'] == $_SESSION['ticket']) {
        $ticket = session_id().microtime().rand(0,9999999999);
        $ticket = hash('sha512', $ticket);
        $_COOKIE['ticket'] = $ticket;
        $_SESSION['ticket'] = $ticket;
    }

    $compte = recup_compte($email, $password);
    $_SESSION['user'] = $compte["user"];
    $_SESSION['role'] = $compte["role"];

    require "templates/back_office.php";
}

function vue_recherche_film(){

    session_start();

    require "templates/recherche_film.php";
}

function recherche_film($title){

    session_start();
    
    //API Key TMBD
    $key = "5683e0da5ac9e167c7bdefc13769c14e";
    
    $title = $_POST["recherche"];
    
    //Consomation de l'API TMDB pour récupéré la liste de film à partir d'un titre de film.
    $json = file_get_contents("https://api.themoviedb.org/3/search/movie?api_key=$key&language=fr&query=$title");

    $result = json_decode($json, true);

    $inc= 0;

    $titre = $result['results'][$inc]['original_title'];

    require "templates/recherche_film.php";

}

function control_form_fields_recherche($title){

    session_start();

    $erreurs = array();

    //API Key TMBD
    $key = "5683e0da5ac9e167c7bdefc13769c14e";
    
    $title = $_POST["recherche"];
        
    //Consomation de l'API TMDB pour récupéré la liste de film à partir d'un titre de film.
    $json = file_get_contents("https://api.themoviedb.org/3/search/movie?api_key=$key&language=fr&query=$title");
    
    $result = json_decode($json, true);

    if ($result['total_results'] == 0) {
        
        $erreurs['recherche'] = "Pas de résultats pour cette recherche.";
    }

    return $erreurs;
}

function vue_formulaire_ajout(){
    
    $titre = urldecode($_GET["titre"]);
    $pitch = urldecode($_GET["pitch"]);

    session_start();

    require "templates/ajout_film.php";
}

function control_form_fields_ajout($image, $cat, $pitch){

    session_start();

    $erreurs = array();

    if (empty($image)) {
        
        $erreurs["image"] = "Veuillez uploader une image !";
    }

    if (empty($cat)) {
        
        $erreurs["cat"] = "Veuillez choisir une catégorie !";
    }

    if (verif_doublon() === true) {
        
        $erreurs["pitch"] = "Film déjà existant dans la base de données !";
    }

    return $erreurs;

}

function ajouter_film_bdd($titre, $sortie, $image, $cat, $pitch){
    session_start();

    $image = "";

    function nom_image($image){

        if (isset($_FILES["affiche"])) {
            $tmp_Name= $_FILES['affiche']['tmp_name'];
            $name= $_FILES['affiche']['name'];
            $type= $_FILES['affiche']['type'];
            $error= $_FILES['affiche']['error'];
            $size= $_FILES['affiche']['size'];

            $scindeName = explode('.', $name);

            $extFichier = strtolower($scindeName[1]);

            $extAuto = ['jpg', 'jpeg', 'gif', 'png'];

            if (in_array($extFichier, $extAuto) && $error == 0) {
                
                move_uploaded_file($tmp_Name,'./img/'.$name);
            } else {
                $erreurs["image"] = "Mauvaise extensions de fichier ou fichier corompu !";
            }

            return $image;
        }
    }

    inserer_film($titre, $sortie, $image, $cat, $pitch);

    require "templates/liste_film.php";
}



function vue_liste_film(){

    session_start();

    $film = get_all_film();

    require "templates/liste_film.php";
}
?>