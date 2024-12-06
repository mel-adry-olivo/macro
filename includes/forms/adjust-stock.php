
<?php

require '../template-components.php';
require '../db-config.php';
require '../db-utils.php';

$warehouses = getWarehouseNames();
?>

<form class="form-wrapper">
    <h1 class="form-title">Adjust Stock</h1>
    <div class="form-layout-main">
        <?php createFormSearchBoxWithSelection("Search Product", "Selected Product"); ?>
        <div class="form-layout-row">
            <?php createFormNumberInput("Quantity Adjusted", "Enter quantity adjusted", true)?>
            <?php createFormButtonGroup("Confirm Adjustment", "Cancel")?>
        </div>
    </div>
</form>
