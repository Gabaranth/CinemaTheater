<?php
require("connect.php");

// Connexion à la BDD
function connect_db()
{
    $dsn = "mysql:dbname=" . BASE . ";host=" . SERVER;
    try {
        $option = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
        $connexion = new PDO($dsn, USER, PASSWD, $option);
    } catch (PDOException $e) {
        printf("Echec connexion : %s\n", $e->getMessage());
        exit();
    }
    return $connexion;
}


function verif_email(){

    $connexion = connect_db();
    $email = $_POST["email"];
    $requete = "SELECT email_user from utilisateur WHERE email_user = :email";
    $reponse = $connexion->prepare($requete);
    $reponse->bindParam(':email', $email);
    $reponse->execute();
    if ($reponse->rowCount()) {
        return true;
    }else {
        return false;
    }
}

function verif_password(){

    $connexion = connect_db();
    $password = $_POST["password"];
    $requete = "SELECT pwd_user from utilisateur WHERE pwd_user = :password";
    $reponse = $connexion->prepare($requete);
    $reponse->bindParam(':password', $password);
    $reponse->execute();
    if ($reponse->rowCount()) {
        return true;
    }else {
        return false;
    }
}

function recup_compte($email, $password){

    $connexion = connect_db();
    $requete = "SELECT * from utilisateur WHERE email_user = :email AND pwd_user = :password";
    $reponse = $connexion->prepare($requete);
    $reponse->bindParam(':email', $email);
    $reponse->bindParam(':password', $password);
    $reponse->execute();
    return $reponse->fetch();
}

function inserer_film($titre, $sortie, $image, $cat, $pitch){

    $connexion = connect_db();
    $requete = "CALL inserer_film(:titre, :sortie, :image, :cat, :pitch)";
    $reponse = $connexion->prepare($requete);
    $reponse->bindParam(':titre', $titre);
    $reponse->bindParam(':sortie', $sortie);
    $reponse->bindParam(':image', $image);
    $reponse->bindParam(':cat', $cat);
    $reponse->bindParam(':pitch', $pitch);
    $reponse->execute();
}

function verif_doublon(){

    $connexion = connect_db();
    $requete = "SELECT pitch_film WHERE pitch_film = :pitch";
    $reponse = $connexion->prepare($requete);
    $reponse->bindParam(':pitch', $pitch);
    $reponse->execute();
    if ($reponse->rowCount()) {
        return true;
    } else {
        return false;
    }
}

function get_all_film(){

    $connexion = connect_db();
    $film = array();
    $requete = "SELECT * FROM film";

    foreach ($connexion->query($requete) as $row){
        $film[] = $row;
    }
    return $film;
}

