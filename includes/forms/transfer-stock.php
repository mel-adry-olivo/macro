<?php

require '../template-components.php';
require '../db-config.php';
require '../db-utils.php';

$warehouses = getWarehouseNames();

?>

<form class="form-wrapper">
    <h1 class="form-title">Transfer Stock</h1>
    <div class="form-layout-main">
        <div class="form-layout-row">
            <?php createFormDropdown("Destination Warehouse", $warehouses) ?>
        </div>
        <?php createFormSearchBoxWithSelection("Search Product", "Selected Product"); ?>
        <div class="form-layout-row">
            <?php createFormNumberInput("Quantity transferred", "Enter quantity to be transferred", true)?>
            <?php createFormButtonGroup("Confirm Transfer", "Cancel")?>
        </div>
    </div>
</form>
