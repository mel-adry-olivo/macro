<?php


require '../includes/db-config.php';
require '../includes/db-utils.php';


if (isset($_GET['warehouseId'])) {
    $warehouseId = $_GET['warehouseId'];
    deleteWarehouseProducts($warehouseId);
    deleteWarehouse($warehouseId);
}

exit();