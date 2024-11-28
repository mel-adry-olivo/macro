<?php 
require '../includes/db-config.php';
require '../includes/template-components.php';

$sql = "SELECT * FROM warehouses WHERE id = $warehouseId";
$result = $conn->query($sql);
$warehouse = $result->fetch_assoc();

$racks = [];
?>

<div class="warehouses warehouses-detail">
    <div class="warehouse-breadcrumb">
           <?php createButton("Back", "move-left", false, true); ?>
    </div>
    <div class="warehouses-header warehouse-header-detail">
        <div class="warehouses-title">
            <h1><?php echo $warehouse['name'] ?></h1>
        </div>
        <div class="row">
            <?php createButton("Create Rack", "box", false)?>   
            <?php createButton("Link Product", "baggage-claim", true)?>
        </div>
    </div>
    <div class="warehouses-toolbar">
        <?php createSearchbar("Search products in warehouse")?>
        <?php if(!empty($racks)) : ?>
            <?php createDropdown($racks, "rack"); ?>
        <?php endif; ?>
    </div>
     <div class="warehouses-list">
        <div class="table">
            <div class="table-header">
                <div class="table-header-item" primary-item>Name</div>
                <div class="table-header-item">Rack #</div>
                <div class="table-header-item">Stock Level</div>
                <div class="table-header-item" actions>Actions</div>
            </div>
            <div class="table-body">
                No products in this warehouse
            </div>
        </div>
     </div>

     <!-- sidebar
            transfer stocks      
            pending transfers
     -->
</div>
<?php require '../includes/warehouse/rack-add-form.php';?>