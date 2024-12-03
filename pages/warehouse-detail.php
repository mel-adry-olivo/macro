<?php 
require '../includes/db-config.php';
require '../includes/db-utils.php';

require '../includes/template-components.php';

$warehouseId = $_GET['id'] ?? '';

$sql = "SELECT * FROM warehouses WHERE id = $warehouseId";
$result = $conn->query($sql);
$warehouse = $result->fetch_assoc();


$racksSql = "SELECT * FROM racks WHERE warehouse_id = " . $warehouse['id'];
$racksResult = $conn->query($racksSql);
$racks = $racksResult->fetch_all(MYSQLI_ASSOC);

?>

<div class="warehouses warehouses-detail" data-id="<?php echo $warehouse['id'] ?>">
    <div class="warehouse-breadcrumb">
           <?php createButton("Back", "move-left", false, true); ?>
    </div>
    <div class="warehouses-header warehouse-header-detail">
        <div class="warehouses-title">
            <h1><?php echo $warehouse['name'] ?> - Racks</h1>
        </div>
        <div class="row">
            <?php createButton("Transfer Stock", "arrow-left-right", false, false, dataForm:".stock-transfer-form", dataOverlay:".stock-transfer-overlay"); ?> 
            <?php createButton("Create Rack", "box", false, dataForm:".rack-add-form", dataOverlay:".rack-add-overlay")?>   
            <?php createButton("Link Product", "map", true, dataForm:".link-product-form", dataOverlay:".link-product-overlay")?>
        </div>
    </div>
    <!-- <div class="warehouses-toolbar">
        <?php //createSearchbar("Search products in warehouse")?>
    </div> -->
    <div class="list-scroll">
        <div class="warehouses-list">
            <div class="table warehouse-table"> 
                <div class="table-header">
                    <div class="table-header-item" primary-item>Rack Name</div>
                    <div class="table-header-item">Max Capacity (units)</div>
                    <div class="table-header-item">Capacity Used</div>
                    <div class="table-header-item">Last Updated</div>
                    <div class="table-header-item" actions>Actions</div>
                </div>
                <div class="table-body">
                    <?php foreach($racks as $rack) createRackTableRow($rack, $warehouseId);?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require '../includes/warehouse/rack-add-form.php';?>
<?php require '../includes/warehouse/link-product-form.php';?>
<?php require '../includes/warehouse/stock-transfer-form.php';?>