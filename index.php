<?php

require './includes/config.php';
require './includes/db-utils.php';
require './includes/template-components.php';

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Macro™</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./styles.css">
    <link rel="stylesheet" href="./utilities.css">
    <script src="script.js" type="module" defer></script>
    <script src="https://unpkg.com/lucide@latest"></script>
  </head>
  <body>
    <div class="container">
        <header class="header">
          <div class="logo">
              <h1><span>M</span>acro.</h1>
          </div>
          <nav class="nav">
            <a class="nav-item" href="<?php echo DASHBOARD_URL ?>">Dashboard</a>
            <a class="nav-item" href="<?php echo ORDERS_URL ?>">Orders</a>
            <a class="nav-item" href="<?php echo PRODUCTS_URL ?>">Products</a>
            <a class="nav-item" href="<?php echo WAREHOUSES_URL ?>">Warehouses</a>
            <a class="nav-item" href="<?php echo SUPPLIERS_URL ?>">Suppliers</a>
          </nav>
          <div class="actions">
              <button class="btn-icon round">
                  <i data-lucide="settings"></i>
              </button>
              <button class="btn-icon round ">
                  <i data-lucide="user"></i>
              </button>
          </div>
      </header>
      <main class="content"></main>
    </div>
  </body>
  <script src="./js/router.js"></script>
</html>
