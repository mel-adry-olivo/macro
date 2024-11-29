<?php 


function getRackBooksByName ($warehouseId, $rackName) {
    global $conn;
    $sql = "SELECT books.*
    FROM warehouse_book 
    JOIN books ON warehouse_book.book_id = books.id
    JOIN racks ON warehouse_book.rack_id = racks.id
    WHERE warehouse_book.warehouse_id = $warehouseId
    AND racks.name = '$rackName'"; 

    $result = $conn->query($sql);
    $books = $result->fetch_all(MYSQLI_ASSOC);

    return $books;
}
function getNotLinkedBooks($warehouseId) {

    global $conn;
    $sql = "SELECT b.* 
    FROM books b
    LEFT JOIN warehouse_book wb ON b.id = wb.book_id AND wb.warehouse_id = 1
    WHERE wb.book_id IS NULL"; 

    $result = $conn->query($sql);
    $books = $result->fetch_all(MYSQLI_ASSOC);

    return $books;
}



function getNotLinkedBookss($warehouseId, $rackName) {

    global $conn;

    $linkedProductsSql = "
    SELECT book_id 
    FROM warehouse_book 
    JOIN racks ON warehouse_book.rack_id = racks.id
    WHERE warehouse_book.warehouse_id = " . $warehouseId . "
    AND racks.name = '$rackName'"; 
    
    $linkedProductsResult = $conn->query($linkedProductsSql);
    $linkedProductIds = [];

    if ($linkedProductsResult) {
        $linkedProducts = $linkedProductsResult->fetch_all(MYSQLI_ASSOC);
        foreach ($linkedProducts as $linkedProduct) {
            $linkedProductIds[] = $linkedProduct['book_id'];
        }
    }

    if (count($linkedProductIds) > 0) {
        $linkedProductIdsStr = implode(',', $linkedProductIds); 
        $productsSql = "
            SELECT * FROM books 
            WHERE id NOT IN ($linkedProductIdsStr)";
    } else {
        $productsSql = "SELECT * FROM books";
    }

    $productsResult = $conn->query($productsSql);
    $products = [];

    if ($productsResult) {
        $products = $productsResult->fetch_all(MYSQLI_ASSOC);
    }
    
    return $products;
}