<?php 

require '../includes/db-config.php';
require '../includes/db-utils.php';
require '../includes/template-components.php';

$data = json_decode(file_get_contents("php://input"), true);

$name = $data["name"] ?? null;
$address = $data["address"] ?? [];
$capacity = $data["capacity"] ?? [];

addWarehouse($name, $address, $capacity);
$warehouseId  = getWarehouseIdByName($name);


$warehouseRow = createWarehouseTableRow(['id' => $warehouseId, 'name' => $name, 'address' => $address, 'max_unit_capacity' => $capacity]);

echo $warehouseRow;
exit();