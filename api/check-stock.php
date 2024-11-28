<?php 

require '../includes/db-config.php';

$sql = "SELECT * FROM books WHERE stock < stock_threshold";
$result = $conn->query($sql);
$books = $result->fetch_all(MYSQLI_ASSOC);


if(count($books) > 0) {
    foreach($books as $book) {

        $notifcationSql = "
            INSERT INTO notifications (message, type) 
            VALUES ('" . $book['name'] ."' , 'low_stock')";
        $conn->query($notifcationSql);
    }
}

echo json_encode($books);
