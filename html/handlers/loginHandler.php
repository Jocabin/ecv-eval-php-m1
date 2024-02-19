<?php
require_once(dirname(__FILE__) . '/../models/User.php');

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

$user = User::verifyPassword($email, $password);

if ($user === false) {
    echo 'Erreur: Identifiants incorrects !';
    exit();
}

session_start();
$_SESSION['userId'] = $user->getId();

header("Location: ../orders-list.php");