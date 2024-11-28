<?php 
require '../includes/db-config.php';
require '../includes/template-components.php';

$sql = "SELECT * FROM racks WHERE id = $rackId";
$result = $conn->query($sql);
$rack = $result->fetch_assoc();

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
        </div>
    </div>
    <div class="warehouses-toolbar">
    </div>
     <div class="warehouses-list">
        
     </div>
</div>
<?php require '../includes/warehouse/rack-add-form.php';?>
