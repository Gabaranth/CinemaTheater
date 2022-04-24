<?php 
$title = "Administrateur Cinema Theater";
var_dump(strval($dataFilm["titre"]));
ob_start();
?>
<header>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
    <a class="navbar-brand" href="#">
        <img src="./img/logo_cinema_theatre.png" alt="" width="30" height="24">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
            <a class="nav-link" aria-current="page" href="index.php">Acceuil</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="index.php?action=web">Ajouter un film via web service</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="index.php?action=liste">Liste de vos films</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="index.php">Front Office</a>
            </li>
        </ul>
        </div>
    </div>
    </nav>
</header>
<main class="container">
    <h1 class="text-center">Ajouter un Nouveau Film</h1>
    <div>
        <form action="index.php?action=bdd" method="POST">
        <p>Titre du film</p>
        <input type="text" name="titre" id="titre" value=<?php echo strval($dataFilm["titre"]) ?>>
        <br>
        <p>Année de sortie</p>
        <input type="text" name="year" id="year" value=<?php echo $dataFilm["date_sortie"]?>>
        <br>
        <p>Affiche du film</p><span><?php if (!empty($erreurs["image"])) {
            echo $erreurs["image"];
        }?></span>
        <input type="file" name="affiche" id="affiche">
        <br>
        <p>Catégorie du film</p><span><?php if (!empty($erreurs["cat"])) {
            echo $erreurs["cat"];
        }?></span>
        <select name="category" id="category">
            <option valeur="">--Choissier une catégorie--</option>
            <option valeur="sf">Science-fiction</option>
            <option valeur="com">Comédie</option>
            <option valeur="act">Action</option>
            <option value="doc">Documentaire</option>
            <option value="hor">Horreur</option>
        </select>
        <br>
        <p>Pitch du film</p><span><?php if (!empty($erreurs["pitch"])) {
            echo $erreurs["pitch"];
        } ?></span>
        <input type="textarea" name="pitch" id="pitch" value=<?php echo $dataFilm["pitch"] ?>>
        <br>
        <input type="reset" value="annuler"><input type="submit" name="bdd" value="envoyer">
        </form>
    </div>
</main>
<?php 
$content = ob_get_clean();
include "baselayout.php";
?>