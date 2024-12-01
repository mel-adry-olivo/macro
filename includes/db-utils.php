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

function getRackBooksById ($warehouseId, $rackId) {
    global $conn;
    $sql = "SELECT *
    FROM warehouse_book 
    JOIN books ON warehouse_book.book_id = books.id
    JOIN racks ON warehouse_book.rack_id = racks.id
    WHERE warehouse_book.warehouse_id = $warehouseId
    AND racks.id = $rackId"; 

    $result = $conn->query($sql);
    $books = $result->fetch_all(MYSQLI_ASSOC);

    return $books;
}

function getNotLinkedBooks($warehouseId) {

    global $conn;
    $sql = "SELECT b.* 
    FROM books b
    LEFT JOIN warehouse_book wb ON b.id = wb.book_id AND wb.warehouse_id = $warehouseId
    WHERE wb.book_id IS NULL"; 

    $result = $conn->query($sql);
    $books = $result->fetch_all(MYSQLI_ASSOC);

    return $books;
}



