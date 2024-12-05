<?php

require '../template-components.php';

?>

<div class="form-wrapper">
    <h1 class="form-title">Ship Orders</h1>
    <div class="form-layout-main">
        <div class="form-layout-row">
            <?php createFormTextInput("Order ID", "Enter order ID")?>
        </div>
        <div class="form-layout-row">
            <?php createFormTextInput("Shipping Address", "Enter shipping address")?>
        </div>
        <div class="form-layout-row">   
            <?php createFormDropdown("Shipping Method", ["Standard", "Express"])?>
            <?php createFormButtonGroup("Confirm Shipment", "Cancel")?>
        </div>
    </div>
</div>
