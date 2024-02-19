<?php
require_once(dirname(__FILE__) . '/models/Product.php');

$productsList = Product::getList();
?>

<?php require './parts/layoutBefore.php' ?>

<h1>Liste des produits</h1>

<ul>
<!--    on affiche la liste des produits-->
    <?php foreach ($productsList as $product): ?>
        <li>
            <a class="item" href="product-view.php?id=<?= $product->getId() ?>">
                <?= $product->getName() ?>
                <span>Cliquer pour commander</span>
            </a>
        </li>
    <?php endforeach; ?>
</ul>

<?php require './parts/layoutAfter.php' ?>
