<?php


require '../includes/db-config.php';
require '../includes/db-utils.php';
require '../includes/template-components.php';

$warehouseId = $_GET['warehouseId'] ?? '';
$rackId = $_GET['rackId'] ?? '';
$warehouseBooks = getRackBooksById($warehouseId, $rackId);

$html = '';
foreach ($warehouseBooks as $book) {
    $html .= createProductRowWithQuantity($book);
}

echo json_encode($html);
exit();