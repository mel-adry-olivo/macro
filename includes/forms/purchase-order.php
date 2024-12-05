<?php

require '../template-components.php';

?>

<div class="form-wrapper">
    <h1 class="form-title">Purchase Order</h1>
    <div class="form-layout-main">
        <?php createFormSearchBoxWithSelection("Search Product"); ?>
        <div class="form-layout-row">   
            <?php createFormNumberInput("Quantity To Order", "Enter quantity to order")?>
            <?php createFormButtonGroup("Confirm Order", "Cancel")?>
        </div>
    </div>
</div>
