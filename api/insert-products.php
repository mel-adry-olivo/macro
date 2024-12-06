<?php

require '../includes/db-config.php';
require '../includes/db-utils.php';

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['products']) && is_array($data['products'])) {
    $products = $data['products'];

    foreach ($products as $product) {
        addProducts($product);
    }
} else {
    echo json_encode(["error" => "No product data provided."]);
}
echo json_encode(["success" => true]);

exit();
?>
