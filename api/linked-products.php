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

echo $productsHTML;
exit();
