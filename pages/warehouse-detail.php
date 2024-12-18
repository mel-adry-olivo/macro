<?php 
require '../includes/db-config.php';
require '../includes/db-utils.php';
require '../includes/template-components.php';

$warehouseId = $_GET['id'] ?? '';
$warehouse = getWarehouse($warehouseId) ?? [];
$warehouseProducts = getWarehouseProducts($warehouseId) ?? [];

?>
<div class="warehouses warehouses-detail" data-id="<?php echo $warehouse['id'] ?>">
    <div class="warehouses-header warehouse-header-detail">
        <div class="warehouses-title">
            <h1><?php echo $warehouse['name'] ?></h1>
        </div>
        <div class="row">
            <?php createFormButton("Adjust Stock", "plus", false, false, "adjust-stock")?>
            <?php createFormButton("Transfer Stock", "arrow-left-right", true, false, "transfer-stock"); ?> 
        </div>
    </div>
    <div class="warehouses-detail-content">
        <div class="list-scroll">
            <div class="warehouses-list">
                <div class="table warehouse-table">
                    <div class="table-header">
                        <div class="table-header-item" primary-item>Name</div>
                        <div class="table-header-item">Stock Quantity</div>
                        <!-- <div class="table-header-item">Rack #</div> -->
                        <div class="table-header-item">Price</div>
                    </div>
                    <div class="table-body">
                        <?php if (!empty($warehouseProducts)): ?>
                            <?php foreach ($warehouseProducts as $product): ?>
                                <?php createProductTableRow($product)?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>No products assigned to this warehouse.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>