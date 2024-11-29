<?php 
require '../includes/db-config.php';
require '../includes/db-utils.php';
require '../includes/template-components.php';

$sql = "SELECT * FROM racks WHERE id = $rackId";
$result = $conn->query($sql);
$rack = $result->fetch_assoc();

$products = getRackBooksById($warehouseId, $rack['id']);


?>

<div class="warehouses warehouses-detail" data-id="<?php echo $rack['id'] ?>">
    <div class="warehouse-breadcrumb">
           <?php createButton("Back", "move-left", false, true); ?>
    </div>
    <div class="warehouses-header warehouse-header-detail">
        <div class="warehouses-title">
            <h1><?php echo $rack['name'] ?></h1>
        </div>
        <div class="row">
            <?php createButton("Update Product", "edit", false)?>
        </div>
    </div>
    <div class="warehouses-toolbar">
        <div class="rack-stat">
            <h2>3 Products</h2>
        </div>
    </div>
     <div class="warehouses-list">
        <div class="table warehouse-table">
            <div class="table-header">
                <div class="table-header-item" primary-item>Product Name</div>
                <div class="table-header-item">Stock Quantity</div>
                <div class="table-header-item" actions>Actions</div>
            </div>
            <div class="table-body">
                <?php foreach($products as $product) { ?>
                    <div class="table-body-item">
                        <!-- <div class="table-body-item-primary">
                            <div class="table-body-item-primary-name"><?php echo $product['name'] ?></div>
                        </div>
                        <div class="table-body-item-secondary">
                            <div class="table-body-item-secondary-quantity"><?php echo $product['quantity'] ?></div>
                        </div>
                        <div class="table-body-item-actions">
                            <div class="table-actions">
                            <button class="btn-icon border" aria-label="view">
                            <i data-lucide="expand"></i>
                            </button>
                            <button class="btn-icon border" aria-label="edit">
                                <i data-lucide="edit"></i>
                            </button>
                            <button class="btn-icon border" aria-label="delete">
                                <i data-lucide="trash-2"></i>
                            </button>
                            </div>
                        </div> -->
                    </div>
                <?php } ?>
            </div>
        </div>
     </div>
</div>
<?php require '../includes/warehouse/rack-add-form.php';?>
