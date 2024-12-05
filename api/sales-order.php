<?php

require '../includes/db-config.php';
require '../includes/db-utils.php';

$data = json_decode(file_get_contents("php://input"), true);

$warehouseName = $data["warehouse"] ?? null;
$warehouseId = getWarehouseIdByName($warehouseName); 

$customerName = $data["customerName"] ?? null;
$selection = $data["selection"] ?? [];
$quantity = $data["quantity"] ?? [];


global $conn;

$conn->begin_transaction();

try {
    $orderDate = date('Y-m-d H:i:s'); 
    $query = "INSERT INTO sales_orders (customer_name, product_names, quantities, order_date)
              VALUES ('$customerName', '" . implode(', ', $selection) . "', '" . implode(', ', $quantity) . "', '$orderDate')";

    if ($conn->query($query) === TRUE) {
        $orderId = $conn->insert_id;  
    } else {
        throw new Exception("Error inserting order: " . $conn->error);
    }

    $productsUpdated = [];
    foreach ($selection as $index => $productName) {

        $productQuantity = $quantity[$index];
        
        $productId = getProductIdByName($productName);
        $product = getProductInWarehouse($productId, $warehouseId);

        if($product === null) {

            throw new Exception("Product out of stock: " . $productName);
        }

        $currentStock = $product['stock_quantity'];

        if ($currentStock >= $productQuantity) {

            $newStock = $currentStock - $productQuantity;
            updateProductQuantity($productId, $newStock, $warehouseId);

            $productsUpdated[] = $productName;
        } else {

            throw new Exception("Not enough stock for product: " . $productName);
        }
    }

    $conn->commit();
    echo json_encode(['success' => true, 'products' => $productsUpdated]);

} catch (Exception $e) {
    $conn->rollback();

    echo json_encode(['error' => $e->getMessage()]);
    http_response_code(500); 
}