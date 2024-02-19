<?php
// on require la classe User, afin de vérifier la connexion au compte
require_once(dirname(__FILE__) . '/../models/User.php');

// on filtre les requête en ne gardant que les POST
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    echo 'Il faut envoyer des données en POST';
    exit();
}

// on récupère l'email et le mot de passe, et on filtre les les caractères spéciaux
$email = filter_var($_POST["email"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$password = filter_var($_POST["password"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

// on vérifie que les 2 informations existent
if (empty($email) || empty($password)) {
    echo "Informations de connexion incomplètes";
    exit();
}

// on vérifie que le mot de passe est correct
$user = User::verifyPassword($email, $password);

if ($user === false) {
    echo 'Erreur: Identifiants incorrects !';
    exit();
}

session_start();
$_SESSION['userId'] = $user->getId();

//redirection vers la page de liste des commandes
header("Location: ../orders-list.php");