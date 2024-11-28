<?php

if(!isset($_GET['content'])) {
    http_response_code(404);
    exit();
}

$content = $_GET['content'];


switch($content) {
    case 'dashboard':
        require '../pages/dashboard.php';
        break;
    case 'orders':
        require '../pages/orders.php';
        break;
    case 'products':
        require '../pages/products.php';
        break;
    case 'warehouses':
        require '../pages/warehouses.php';
        break;
    case 'suppliers':
        require '../pages/suppliers.php';
        break;
    default:
        http_response_code(404);
        exit();
}

