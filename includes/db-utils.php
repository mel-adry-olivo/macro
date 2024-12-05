<?php 

function getProducts() {
    global $conn;
    $sql = "SELECT * FROM products";
    $result = $conn->query($sql);
    $products = $result->fetch_all(MYSQLI_ASSOC);

    return $products;
}

function getWarehouses() {
    global $conn;
    $sql = "SELECT * FROM warehouses";
    $result = $conn->query($sql);
    $warehouses = $result->fetch_all(MYSQLI_ASSOC);

    return $warehouses;
}

function getWarehouseIdByName($name) {
    global $conn;
    $sql = "SELECT * FROM warehouses WHERE name = '$name'";
    $result = $conn->query($sql);
    $warehouse = $result->fetch_assoc();

    return $warehouse['id'];
}

function getProductIdByName($name) {
    global $conn;
    $sql = "SELECT * FROM products WHERE name = '$name'";
    $result = $conn->query($sql);
    $product = $result->fetch_assoc();

    return $product['id'];
}

function getProductInWarehouse($productId, $warehouseId) {
    global $conn;
    $sql = "SELECT * FROM warehouse_product WHERE product_id = $productId AND warehouse_id = $warehouseId";
    $result = $conn->query($sql);
    $product = $result->fetch_assoc();

    return $product;
}

function updateProductQuantity($productId, $quantity, $warehouse) {
    global $conn;
    $sql = "UPDATE warehouse_product SET stock_quantity = $quantity WHERE product_id = $productId AND warehouse_id = $warehouse"; ;
    $conn->query($sql);
}

function addProductToWarehouse($productId, $warehouseId, $quantity) {
    global $conn;
    $sql = "INSERT INTO warehouse_product (product_id, warehouse_id, stock_quantity) VALUES ($productId, $warehouseId, $quantity)";
    $conn->query($sql);
}

function getWarehouseProducts($warehouseId) {
    global $conn;
    $sql = "
        SELECT 
            p.id AS product_id,
            p.image AS product_image,
            p.name AS product_name,
            p.category AS product_category,
            p.price AS price,
            wp.stock_quantity AS stock_quantity,
            r.id AS rack_id,
            r.name AS rack_name
        FROM 
            products p
        JOIN 
            warehouse_product wp ON p.id = wp.product_id
        LEFT JOIN 
            racks r ON wp.rack_id = r.id
        WHERE 
            wp.warehouse_id = '$warehouseId';
    ";
    $result = $conn->query($sql);
    
    if (!$result) {
        return [];
    }
    
    $products = $result->fetch_all(MYSQLI_ASSOC);
    return $products;
}
function getWarehouse($warehouseId) {
    global $conn;
    $sql = "SELECT * FROM warehouses WHERE id = $warehouseId";
    $result = $conn->query($sql);
    $warehouse = $result->fetch_assoc();

    return $warehouse;
}

function getWarehouseNames() {
    global $conn;
    $sql = "SELECT * FROM warehouses";
    $result = $conn->query($sql);
    $warehouses = $result->fetch_all(MYSQLI_ASSOC);
    $warehouseNames = [];
    
    foreach($warehouses as $warehouse) {
        $warehouseNames[] = $warehouse['name'];
    }

    return $warehouseNames;
}


function getWarehouseRacks($warehouseId) {
    global $conn;
    $sql = "SELECT * FROM racks WHERE warehouse_id = $warehouseId";
    $result = $conn->query($sql);
    $racks = $result->fetch_all(MYSQLI_ASSOC);
    return $racks;
}

function logInbound($warehouseName, $operation, $quantity, $productNames, $now) {
    global $conn;
    $sql = "INSERT INTO 
        inbound_transactions (warehouse, operation, quantity, products, timestamp) 
        VALUES ('$warehouseName', '$operation', $quantity, '$productNames', '$now')";
    $conn->query($sql);
}

function logOutbound($customerName, $operation, $quantity, $productNames, $now) {
    global $conn;
    $sql = "INSERT INTO 
        outbound_transactions (customer_name, operation, quantity, products, timestamp) 
        VALUES ('$customerName', '$operation', $quantity, '$productNames', '$now')";
        
    $conn->query($sql);
}

function getInboundTransactions() {
    global $conn;
    $sql = "SELECT * FROM inbound_transactions";
    $result = $conn->query($sql);
    $transactions = $result->fetch_all(MYSQLI_ASSOC);
    return $transactions;
}


function getOutboundTransactions() {
    global $conn;
    $sql = "SELECT * FROM outbound_transactions";
    $result = $conn->query($sql);
    $transactions = $result->fetch_all(MYSQLI_ASSOC);
    return $transactions;
}