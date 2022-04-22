<?php 
$title = "Connexion administrateur";
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
            <a class="nav-link" href="#">Les films par genre</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="#">Les films par année</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="index.php">Front Office</a>
            </li>
        </ul>
        </div>
    </div>
    </nav>
</header>
<div class="container d-flex justify-content-center">
    <img class="logo" src="./img/logo_cinema_theatre.png" alt="">
</div>
<h1 class="text-center">Connexion espace Administrateur</h1>
    <div class="container">
        <form action="index.php?action=connexion" method="POST">
            <table class="table">
                <tr>
                    <td><label for="Email">Email :</label></td>
                    <td><input type="text" name="email" id="idEmail"></td>
                    <td><span><?php if (!empty($erreurs["email"])) {
                        echo $erreurs["email"];
                    }?></span></td>
                </tr>
                <tr>
                    <td><label for="pass">Mot de passe :</label></td>
                    <td><input type="password" name="password" id="idPass"></td>
                    <td><?php if (!empty($erreurs["password"])) {
                        echo $erreurs["password"];
                    } ?></td>
                </tr>
                <tr>
                    <td><input type="submit" value="Valider" class="mx-3"><input type="reset" value="Annuler"></td>
                </tr>
            </table>
        </form>
    </div>
<?php 
$content = ob_get_clean();
include "baselayout.php";
?>