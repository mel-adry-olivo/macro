<?php

require '../includes/template-components.php';
require '../includes/db-config.php';
require '../includes/db-utils.php';

$data = json_decode(file_get_contents("php://input"), true);

$warehouse = $data["warehouse"] ?? null;
$operation = $data["operation"] ?? null;    
$quantity = $data["quantity"] ?? null;
$productNames = $data["products"] ?? null;
$now = date("Y-m-d H:i:s");

logOutbound($warehouse, $operation, $quantity, $productNames, $now);

$transaction = [
    "warehouse" => $warehouse,
    "operation" => $operation,
    "products" => $productNames,
    "quantity" => $quantity,
    "timestamp" => $now
];

$transactionCard = createOutboundTransactionCard($transaction);

http_response_code(200);
echo $transactionCard;
