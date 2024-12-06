<?php 

function addProducts($product) {
    global $conn;
    $image = $product['image'];
    $name = $product['name'];
    $category = $product['category'];
    $stock = $product['stock'];
    $reorder_level = $product['reorder_level'];
    $price = $product['price'];
    $supplier_name = $product['supplier_name'];
    $supplier_address = $product['supplier_address'];

    $query = "INSERT INTO products (image, name, category, stock, reorder_level, price, supplier_name, supplier_address) 
                VALUES ('$image', '$name', '$category', $stock, $reorder_level, $price, '$supplier_name', '$supplier_address')";

    if ($conn->query($query) === TRUE) {
        // Success
    } else {
        // Error
    }
}

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

function deleteWarehouse($warehouseId) {
    global $conn;
    $sql = "DELETE FROM warehouses WHERE id = $warehouseId";
    $conn->query($sql);
}

function deleteWarehouseProducts($warehouseId) {
    global $conn;
    $sql = "DELETE FROM warehouse_product WHERE warehouse_id = $warehouseId";
    $conn->query($sql);
}

function getAllWarehouses() {
    global $conn;
    $sql = "
    SELECT 
        w.*,
        SUM(wp.stock_quantity) AS total_stock
    FROM 
        warehouses w
    LEFT JOIN 
        warehouse_product wp ON w.id = wp.warehouse_id
    GROUP BY 
        w.id, w.name, w.address
    ";
    $result = $conn->query($sql);
    $warehouses = $result->fetch_all(MYSQLI_ASSOC);

    return $warehouses;
}

function addWarehouse($name, $address, $capacity) {
    global $conn;
    $sql = "INSERT INTO 
        warehouses (name, address, max_unit_capacity) 
        VALUES ('$name', '$address', $capacity)";
    $conn->query($sql);
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

function logOutbound($warehouse, $operation, $quantity, $productNames, $now) {
    global $conn;
    $sql = "INSERT INTO 
        outbound_transactions (warehouse, operation, quantity, products, timestamp) 
        VALUES ('$warehouse', '$operation', $quantity, '$productNames', '$now')";
        
    $conn->query($sql);
}

function getInboundTransactions() {
    global $conn;
    $sql = "SELECT * FROM inbound_transactions ORDER BY timestamp DESC";
    $result = $conn->query($sql);
    $transactions = $result->fetch_all(MYSQLI_ASSOC);
    return $transactions;
}


function getOutboundTransactions() {
    global $conn;
    $sql = "SELECT * FROM outbound_transactions ORDER BY timestamp DESC";
    $result = $conn->query($sql);
    $transactions = $result->fetch_all(MYSQLI_ASSOC);
    return $transactions;
}

function getTotalStockValue() {
    global $conn;
    $sql = "
    SELECT 
        p.id AS product_id,
        p.name AS product_name,
        SUM(wp.stock_quantity) AS total_stock,
        p.price AS unit_price,
        SUM(wp.stock_quantity * p.price) AS total_stock_value
    FROM 
        warehouse_product wp
    JOIN 
        products p ON wp.product_id = p.id
    GROUP BY 
        p.id, p.name, p.price";
    $result = $conn->query($sql);
    $total = $result->fetch_assoc();
    return $total['total_stock_value'];
}

function getRandomTransaction() {
    global $conn;
    
    $sql = "
    SELECT * FROM 
    (SELECT 'inbound' AS type, id, warehouse, operation, quantity, products, timestamp FROM inbound_transactions
     UNION ALL 
     SELECT 'outbound' AS type, id, warehouse, operation, quantity, products, timestamp FROM outbound_transactions) AS combined
    ORDER BY RAND() LIMIT 4;"; 

    $result = $conn->query($sql);
    if ($result) {
        $transaction = $result->fetch_all(MYSQLI_ASSOC);
        return $transaction ? $transaction : null;
    } 
}
