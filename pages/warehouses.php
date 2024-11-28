<?php 

require '../includes/db-config.php';
require '../includes/template-components.php';

$categories = ['All'];
$sql = "SELECT * FROM warehouses LIMIT 5";
$result = $conn->query($sql);
$warehouses = $result->fetch_all(MYSQLI_ASSOC);

?>

<div class="warehouses">
    <div class="warehouse-breadcrumb">
        <?php createButton("Warehouse", "", false, true); ?>
    </div>
    <div class="warehouses-header">
        <div class="warehouses-title">
            <h1>Warehouses</h1>
            </div>
            <div class="row">
                <?php createButton("Import CSV", "import", false)?>
                <?php createButton("Add Warehouse", "plus", true)?>
            </div>
        </div>
    <div class="warehouses-toolbar">
        <?php createSearchbar("Search warehouses")?>
        <?php createDropdown($categories, "filter") ?>
    </div>
     <div class="warehouses-list">
        <div class="table warehouse-table">
            <div class="table-header">
                <div class="table-header-item" primary-item>Name</div>
                <div class="table-header-item">Address</div>
                <div class="table-header-item" actions>Actions</div>
            </div>
            <div class="table-body">
                <?php foreach($warehouses as $warehouse) { createWarehouseTableRow($warehouse); } ?>
            </div>
        </div>
     </div>
</div>