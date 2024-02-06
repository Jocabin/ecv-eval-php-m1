<?php
// Si l'utilisateur est déjà connecté, on le redirige vers la liste des commandes
if (session_id() || $_COOKIE['PHPSESSID']) {
    header('Location: order/index.php');
}
?>

<?php require 'parts/layoutBefore.php' ?>

<form action="handlers/loginHandler.php" method="POST">
    <label for="email">
        Email
        <input type="email" name="email" id="email">
    </label>

    <label for="password">
        Mot de passe
        <input type="password" name="password" id="password">
    </label>

    <button>Se connecter</button>
    <a href="register.php">Inscription</a>
</form>

<?php require 'parts/layoutAfter.php' ?>