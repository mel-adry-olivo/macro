<?php

require '../includes/config.php';
require '../includes/template-components.php';

$action = $_GET['action'] ?? '';

if($action === 'delete') {
    $rackId = $_GET['rackId'] ?? '';
    $warehouseId = $_GET['warehouseId'] ?? '';
    $sql = "DELETE FROM racks WHERE id = $rackId";
    $conn->query($sql);

    exit();
} else if ($action === 'create') {

    $data = file_get_contents('php://input');
    $decodedData = json_decode($data, true);    

    $warehouseId = $decodedData['warehouse_id'];
    $name = $decodedData['rack-name'];
    $capacity = $decodedData['rack-capacity'];
    
    $sql = "INSERT INTO racks (warehouse_id, name, max_unit_capacity) VALUES ($warehouseId, '$name', $capacity)";
    $conn->query($sql);
    
    $getSql = "SELECT * FROM racks WHERE warehouse_id = $warehouseId AND name = '$name' AND max_unit_capacity = $capacity";
    $result = $conn->query($getSql);
    $rack = $result->fetch_assoc();

    $rackHtml = createRackTableRow($rack);

    echo $rackHtml;
    exit();
} else if ($action === 'link') {

    $data = file_get_contents('php://input');
    $decodedData = json_decode($data, true);

    $rackName = $decodedData['rackName'];
    $rackSql = "SELECT * FROM racks WHERE name = '$rackName'";
    $rackResult = $conn->query($rackSql);
    $rack = $rackResult->fetch_assoc();
    $rackId = $rack['id'];

    $warehouseId = $decodedData['warehouse_id'];
    $bookIds = $decodedData['bookIds'];


    foreach ($bookIds as $bookId) {
        $sql = "
            INSERT INTO warehouse_book (book_id, warehouse_id, rack_id, quantity) 
            VALUES ($bookId, $warehouseId, $rackId, 0)";
        $conn->query($sql);
    }

    echo json_encode(['rackId' => $rackId]);
    exit();
}
?>