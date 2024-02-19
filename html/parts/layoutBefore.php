<?php
// Si l'utilisateur essaie d'accéder à d'autres pages que l'inscription/la connexion sans être connecté, il est redirigé
if ($_SERVER['REQUEST_URI'] !== '/' && $_SERVER['REQUEST_URI'] !== '/register.php') {
    session_start();

    if (!isset($_SESSION['userId'])) {
        header('Location: /');
    }
}
?>

<html lang="fr">
<head>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>

<!--    on affiche le menu de navigation que pour les clients connectés-->
<?php if (isset($_SESSION['userId'])) : ?>

<nav class="menuNav">
    <a href="../orders-list.php">Liste des commandes</a>
    <a href="../products-list.php">Liste des produits</a>

        <form action="../handlers/logout.php" style="margin-right: 0;">
            <input type="hidden" name="userId" value="<?= $_SESSION['userId'] ?>">
            <button>Déconnexion</button>
        </form>
</nav>

<?php endif; ?>