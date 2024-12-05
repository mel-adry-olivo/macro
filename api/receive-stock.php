<?php


require '../includes/db-config.php';
require '../includes/db-utils.php';

$data = json_decode(file_get_contents("php://input"), true);

$warehouseName = $data["warehouse"] ?? null;
$selection = $data["selection"] ?? [];
$quantities = $data["quantity"] ?? [];


$warehouseId = getWarehouseIdByName($warehouseName); 
foreach ($selection as $index => $productName) {
    
    $productId = getProductIdByName($productName);
    $product = getProductInWarehouse($productId, $warehouseId);
    $quantity = $quantities[$index];

    // product exists
    if ($product) {
    
        $productQuantity = $product["stock_quantity"];
        $newQuantity = $productQuantity + $quantity;

        updateProductQuantity($productId, $newQuantity, $warehouseId);
    } else {

        addProductToWarehouse($productId, $warehouseId, $quantity);
    }


}
http_response_code(200);
echo json_encode(["success" => "Stock data has been updated"]);