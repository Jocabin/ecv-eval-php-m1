<?php require './parts/layoutBefore.php' ?>

<?php
require_once(dirname(__FILE__) . '/models/Order.php');
require_once(dirname(__FILE__) . '/models/Product.php');

// on récupère la liste de toutes les commandes
$orders = Order::getList($_SESSION['userId']);
?>

    <h1>Liste des commandes</h1>

<!--on affiche la liste de toutes les commandes-->
<?php foreach ($orders as $order) : ?>
    <div class="item">
        <p>Commande n°<?= $order->getId() ?></p>
        <p>Prix total : <?= $order->getTotal() ?> €</p>
        <p>Produit : <?= Product::get($order->getProductId())->getName() ?></p>
    </div>
<?php endforeach; ?>

<?php require './parts/layoutAfter.php' ?>