<?php

require '../includes/db-config.php';
require '../includes/db-utils.php';

$data = json_decode(file_get_contents("php://input"), true);

$warehouseSource = $data["warehouseSource"] ?? null;
$warehouseDestination = $data["warehouseDestination"] ?? null;
$selection = $data["selection"] ?? [];
$quantities = $data["quantity"] ?? [];


$warehouseSourceId = getWarehouseIdByName($warehouseSource);
$warehouseDestinationId = getWarehouseIdByName($warehouseDestination);

$conn->begin_transaction();

try {
    foreach ($selection as $index => $productName) {
        $quantity = $quantities[$index];
        $productId = getProductIdByName($productName);

        if (!$productId) {
            throw new Exception("Product not found: $productName");
        }

        $sourceProduct = getProductInWarehouse($productId, $warehouseSourceId);

        if (!$sourceProduct || $sourceProduct['stock_quantity'] < $quantity) {
            throw new Exception("Insufficient/No stock for product: $productName in $warehouseSource");
        }

        $newSourceQuantity = $sourceProduct['stock_quantity'] - $quantity;
        updateProductQuantity($productId, $newSourceQuantity, $warehouseSourceId);

        $destinationProduct = getProductInWarehouse($productId, $warehouseDestinationId);

        if ($destinationProduct) {
            $newDestinationQuantity = $destinationProduct['stock_quantity'] + $quantity;
            updateProductQuantity($productId, $newDestinationQuantity, $warehouseDestinationId);
        } else {
            addProductToWarehouse($productId, $warehouseDestinationId, $quantity);
        }
    }

    $conn->commit();

    http_response_code(200);
    echo json_encode(["success" => "Stock transfer completed successfully", "id" => $productId, "quantity" => $newSourceQuantity]);

} catch (Exception $e) {
    $conn->rollback();
    http_response_code(500);
    echo json_encode(["error" => $e->getMessage()]);
}
