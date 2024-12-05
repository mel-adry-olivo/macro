<?php

require '../includes/db-config.php';
require '../includes/template-components.php';
require '../includes/db-utils.php';


$products = getProducts();
echo json_encode($products);
exit();