<?php

require '../includes/db-config.php';
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
}


?>