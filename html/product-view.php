<?php
require_once(dirname(__FILE__) . '/models/Product.php');

//on récupère l'ID du produit passé par paramètres dans l'URL, puis on récupère le produit associé
$productId = $_GET['id'];
$product = Product::get($productId);
?>

<?php require './parts/layoutBefore.php' ?>

<h1>Détail du produit</h1>

<p><strong>Nom du produit: </strong><?= $product->getName() ?></p>
<p><strong>Prix: </strong><?= $product->getPrice() ?></p>
<p><strong>Description: </strong><?= $product->getDescription() ?></p>

<form action="handlers/newOrderHandler.php" method="POST">
    <input type="hidden" name="userId" value="<?= $_SESSION['userId'] ?>">
    <input type="hidden" name="productId" value="<?= $product->getId() ?>">

    <button>Commander ce produit</button>
</form>

<?php require './parts/layoutAfter.php' ?>