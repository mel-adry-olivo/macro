<?php

require '../template-components.php';

?>

<div class="form-wrapper">
    <h1 class="form-title">Sales Order</h1>
    <div class="form-layout-main">
        <div class="form-layout-row">
            <?php createFormTextInput("Customer Name", "Enter customer name")?>
        </div>
        <?php createFormSearchBoxWithSelection("Search Product"); ?>
        <div class="form-layout-row">   
            <?php createFormNumberInput("Quantity Sold", "Enter quantity to order", true)?>
            <?php createFormButtonGroup("Confirm Sale", "Cancel")?>
        </div>
    </div>
</div>
