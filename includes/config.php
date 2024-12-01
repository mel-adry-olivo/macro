<?php

define('BASE_URL', './');
define('DASHBOARD_URL', BASE_URL . 'pages/dashboard.php');
define('ORDERS_URL', BASE_URL . 'pages/orders.php');
define('PRODUCTS_URL', BASE_URL . 'pages/products.php');
define('WAREHOUSES_URL', BASE_URL . 'pages/warehouses.php');
define('WAREHOUSE_DETAIL_URL', BASE_URL . 'pages/warehouse-detail.php');
define('SUPPLIERS_URL', BASE_URL . 'pages/suppliers.php');

// Database
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "macro");

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conn->connect_error) {
    exit("Connection failed: " . $conn->connect_error);
}