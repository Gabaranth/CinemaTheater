<?php 
$title = "Administrateur Cinema Theater";
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
<?php 
$content = ob_get_clean();
include "baselayout.php";
?>