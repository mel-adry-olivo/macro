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
    $adjustmentQuantity = $quantities[$index];

    if ($product) {
        $currentQuantity = $product['stock_quantity'];
        
        if ($adjustmentQuantity > $currentQuantity) {
            $adjustmentType = "inbound";
            $adjustmentChange = $adjustmentQuantity - $currentQuantity;
        } elseif ($adjustmentQuantity < $currentQuantity) {
            $adjustmentType = "outbound";
            $adjustmentChange = $currentQuantity - $adjustmentQuantity;
        } 


        updateProductQuantity($productId, $adjustmentQuantity, $warehouseId);
        


    } else {
        http_response_code(500);
        echo json_encode(["error" => "$productName is not in warehouse."]);
        exit();
    }

   
}

http_response_code(200);
echo json_encode(
    ["success" => "Stock data has been updated successfully.", 
    "adjustmentType" => $adjustmentType,
    "adjustmentChange" => $adjustmentChange]);
exit();
?>
