<?php 

require '../includes/template-components.php';

?>


<div class="orders">
    <div class="orders-header">
        <div class="orders-title">
            <h1>Orders</h1>
        </div>
        <div class="orders-actions">
            <?php createSearchbar("Search orders")?>
            <?php createButton("New Purchase", "shopping-basket", true)?>
        </div>
    </div>
    <div class="orders-sidebar">
        <!-- filter by status, location, date, supplier -->
    </div>
    <div class="orders-list">
        <!-- cards of orders -->
    </div>
</div>