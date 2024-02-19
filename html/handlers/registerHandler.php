<?php
require_once(dirname(__FILE__) . '/../models/User.php');

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    echo 'Il faut envoyer des données en POST';
    exit();
}

$username = filter_var($_POST["pseudo"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$email = filter_var($_POST["email"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$password = filter_var($_POST["password"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$confirmPassword = filter_var($_POST["confirm_password"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

if (empty($username) || empty($email) || empty($password) || empty($confirmPassword)) {
    echo "Informations d'inscription incomplètes";
    exit();
}

if ($password !== $confirmPassword) {
    echo 'Les mots de passes ne correspondent pas';
    exit();
}

$userAccount = new User();
$result = $userAccount
    ->setUsername($username)
    ->setEmail($email)
    ->setPassword($password)
    ->save();

header("Location: ../orders-list.php");