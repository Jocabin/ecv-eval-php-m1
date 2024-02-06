<?php require 'parts/layoutBefore.php' ?>

<form action="handlers/registerHandler.php" method="POST">
    <h1>Inscription</h1>
    <label for="pseudo">
        Pseudo
        <input type="text" name="pseudo" id="pseudo" required>
    </label>

    <label for="email">
        Email
        <input type="email" name="email" id="email" required>
    </label>

    <label for="password">
        Mot de passe
        <input type="password" name="password" id="password" required>
    </label>

    <label for="confirm_password">
        Confirmation de mot de passe
        <input type="password" name="confirm_password" id="confirm_password" required>
    </label>

    <button>Créer un compte</button>
    <a href="index.php">Retour à l'accueil</a>
</form>

<?php require 'parts/layoutAfter.php' ?>