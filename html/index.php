<?php
session_start();

if (isset($_SESSION['userId'])) {
    header('Location: orders-list.php');
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
    <a href="./register.php">Inscription</a>
</form>

<?php require 'parts/layoutAfter.php' ?>