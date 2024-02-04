<?php
//require_once(dirname(__FILE__) . '/../models/Author.php');
?>

<html lang="fr">
<head>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
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

</body>
</html>

