<?php 

require '../includes/db-config.php';
require '../includes/db-utils.php';
require '../includes/template-components.php';

$warehouses = getAllWarehouses();

?>

<div class="warehouses">
    <div class="warehouses-header">
        <div class="warehouses-title">
            <h1>Warehouses</h1>
            </div>
            <div class="row">
                <?php createFormButton("Add Warehouse", "plus", true, false, 'add-warehouse')?>
            </div>
        </div>
    <div class="list-scroll">
        <div class="warehouses-list">
            <div class="table warehouse-table">
                <div class="table-header">
                    <div class="table-header-item" primary-item>Name</div>
                    <div class="table-header-item">Address</div>
                    <div class="table-header-item">Total Stocks</div>
                    <div class="table-header-item">Capacity</div>
                    <div class="table-header-item" actions>Actions</div>
                </div>
                <div class="table-body">
                    <?php foreach($warehouses as $warehouse) { createWarehouseTableRow($warehouse); } ?>
                </div>
            </div>
        </div>
    </div>
</div>