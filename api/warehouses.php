<?php

if(!isset($_GET['wid'])) {
    http_response_code(404);
    exit();
}

$warehouseId = $_GET['wid'];
require '../pages/warehouse-detail.php';
?>

