<?php
require_once(dirname(__FILE__) . '/../models/Order.php');
require_once(dirname(__FILE__) . '/../models/Product.php');

$productId = $_POST['productId'];
$userId = $_POST['userId'];

// on récupère les informations complètes du produit via son ID
$product = Product::get($productId);

// on crée une nnouvelle commande et on spécifie le produit, le prix total et l'ID du client
$order = new Order();
$order->setTotal($product->getPrice())->setProductId($productId)->setUserId($userId)->save();

header('Location: ../orders-list.php');