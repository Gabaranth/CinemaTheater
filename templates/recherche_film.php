<?php 
$title = "Recherche Film Cinema Theater";
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
            <a class="nav-link" href="index.php?action=ajouter">Ajouter un film via web service</a>
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
    <h1 class="text-center">Rechercher le film avec le titre</h1>
    <div>
        <form action="index.php?action=recherche" method="POST">
            <p>Rechercher : <input type="text" name="recherche" id="recherche"></p>
            <span><?php 
                if (!empty($erreurs["recherche"])) {
                    echo $erreurs["recherche"];
                    var_dump($erreurs["recherche"]);
                }
            ?></span>
            <button type="submit"><img src="./img/loupe.png" alt=""  width="30" height="24"></button>
        </form>
    </div>
    <div class="container" id="film">
        <?php
            if (!isset($_POST["recherche"])) {
                $result = false;
            } else {
                $total = count($result['results']);
                do {
                    $titre = $result['results'][$inc]['original_title'];
                    $date = $result['results'][$inc]['release_date'];
                    $pitch = $result['results'][$inc]['overview'];

                    echo "<div class='film'>";
                    echo "<h1 class='text-center'>".$titre."</h1>";
                    echo "<div class='d-flex justify-content-center mt-3'>";
                    echo "<img class='img_film'src=https://image.tmdb.org/t/p/w342/".$result['results'][$inc]['poster_path'].">";
                    echo "</div>";
                    echo "<br>";
                    echo "<span class='mt-3'> Année de sortie :"." ".$date."</span>";
                    echo "<div class='mt-3'>";
                    echo "<p>".$pitch."</p>";
                    echo "</div>";
                    echo "<a class='text-center'href=index.php?action=ajout&titre=".urlencode($titre)."&date=$date&pitch=".urlencode($pitch).">Ajouter le film</a>";
                    echo "</div>";
                    $inc++;
                } while ($inc <= $total-1);
            }
        ?>
    </div>
</main>
<?php 
$content = ob_get_clean();
include "baselayout.php";
?>