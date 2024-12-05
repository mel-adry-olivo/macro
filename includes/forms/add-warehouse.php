<?php

require '../template-components.php';

?>

<div class="form-wrapper">
    <h1 class="form-title">Add Warehouse</h1>
    <div class="form-layout-main">
        <div class="form-layout-row">   
            <?php createFormTextInput("Warehouse Name", "Enter warehouse name") ?>
        </div>
        <div class="form-layout-row">
            <?php createFormTextInput("Warehouse Address", "Enter warehouse address")?>
        </div>
        <div class="form-layout-row">
            <?php createFormNumberInput("Capacity", "Enter warehouse capacity")?>
            <?php createFormButtonGroup("Add Product", "Cancel")?>
        </div>
    </div>
</div>
