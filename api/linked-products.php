<?php

require '../includes/db-config.php';
require '../includes/template-components.php';
require '../includes/db-utils.php';

$rackName = $_GET['value'];
$warehouseId = $_GET['warehouse_id'];


$products = getNotLinkedBooks($warehouseId);

$productsHTML = "";
foreach ($products as $product) {
    $productsHTML .= createSimpleProductRow($product);
}

if($productsHTML === "") {
    echo "<p>All products already linked</p>";
    exit();
}


echo $productsHTML;
exit();
