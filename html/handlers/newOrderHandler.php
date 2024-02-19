<?php
require_once(dirname(__FILE__) . '/../models/Order.php');
require_once(dirname(__FILE__) . '/../models/Product.php');

$productId = $_POST['productId'];
$userId = $_POST['userId'];

$product = Product::get($productId);

$order = new Order();

$order->setTotal($product->getPrice())->setProductId($productId)->setUserId($userId)->save();

header('Location: ../orders-list.php');