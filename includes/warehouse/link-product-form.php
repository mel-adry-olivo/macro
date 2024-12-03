<?php

$racksSql = "SELECT racks.name FROM racks WHERE warehouse_id = " . $warehouseId;
$racksResult = $conn->query($racksSql);
$rackNames = [];

if ($racksResult) {
    $racks = $racksResult->fetch_all(MYSQLI_ASSOC);

    foreach ($racks as $rack) {
        $rackNames[] = $rack['name'];
    }
}

$initalBooks = getNotLinkedBooks( $warehouseId);
?>

<form class="modal-form link-product-form">
    <h1 class="modal-form-title">Link a product to a rack</h1>
    <div class="flow flex-1">
        <div class="field-group">
            <?php createDropdownWithLabel("Rack", $rackNames)?>
        </div>
        <div class="field-group">
            <div class="table scrollable">
                <div class="table-header space-between ">
                    <div class="table-header-item unflex">Name</div>
                    <div class="table-header-item unflex">
                        <input type="checkbox" class="select-all-checkbox">
                    </div>
                </div>
                <div class="table-body">
                    <?php if(!empty($initalBooks)) : ?>
                        <?php foreach($initalBooks as $book) { createProductTableRow($book); } ?>
                    <?php else : ?>
                        <div class="table-body-item">All products already linked</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row button-row">
        <button class="btn btn-no-border btn-cancel link" type="button" data-form=".link-product-form" data-overlay=".link-product-overlay">Cancel</button>
        <button class="btn btn-primary link" >Link products</button>
    </div>
    <input type="hidden" name="warehouse_id" value="<?php echo $warehouseId; ?>">
</form>
<div class="page-overlay link-product-overlay"></div>


