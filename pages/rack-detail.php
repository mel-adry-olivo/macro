<?php 
require '../includes/db-config.php';
require '../includes/db-utils.php';
require '../includes/template-components.php';

$rackId = $_GET['rack'] ?? '';
$warehouseId = $_GET['id'] ?? '';


$sql = "SELECT * FROM racks WHERE id = $rackId AND warehouse_id = $warehouseId"; ;
$result = $conn->query($sql);
$rack = $result->fetch_assoc();

$products = getRackBooksById($warehouseId, $rackId);


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
            <?//php createButton("Update Product", "edit", false)?>
        </div>
    </div>
    <div class="warehouses-toolbar">
        <div class="rack-stat">
            <h2><?php echo count($products) ?> Products</h2>
        </div>
    </div>
    <div class="list-scroll">
        <div class="warehouses-list">
            <div class="table warehouse-table">
                <div class="table-header">
                    <div class="table-header-item">Product Name</div>
                    <div class="table-header-item">Author</div>
                    <div class="table-header-item">Price</div>
                    <div class="table-header-item">Stock Quantity</div>
                </div>
                <div class="table-body">
                <?php foreach($products as $product) { ?>
                        <div class="table-row">
                            <div class="table-row-item"><span class="name"><?php echo $product['name'] ?></span></div>
                            <div class="table-row-item"><?php echo $product['author'] ?></div>
                            <div class="table-row-item"><?php echo $product['price'] ?></div>
                            <div class="table-row-item"><?php echo $product['quantity'] ?></div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require '../includes/warehouse/rack-add-form.php';?>
