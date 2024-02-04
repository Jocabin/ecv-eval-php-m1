<?php
require_once(dirname(__FILE__) . '/../models/User.php');

session_start();

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    echo 'Il faut envoyer des données en POST';
    exit();
}

$email = filter_var($_POST["email"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$password = filter_var($_POST["password"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

if (empty($email) || empty($password)) {
    echo "Informations de connexion incomplètes";
    exit();
}

if (User::verifyPassword($email, $password) === false) {
    echo 'Erreur: Identifiants incorrects !';
    exit();
}

// todo to show
echo 'Connexion réussie.';
header("Location: ../order/index.php");
?>