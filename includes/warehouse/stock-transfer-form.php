<?php

$choices = [
    'warehouse' => 'box',
    'racks' => 'archive'
]

?>

<form action="./api/rack.php" method="POST" class="modal-form stock-transfer-form form-container" >
    <h1 class="modal-form-title">Transfer stocks</h1>
    
    <?php createRadioGroup($choices, 'storage', 'Select where to transfer')?>
    <div class="dropdown dropdown-warehouse">
        <div class="dropdown-wrapper">
            <div class="input-container">
                <div class="fill-space select-container" data-action="warehouse">
                </div>
                <i data-lucide="chevron-down"></i>
            </div>
            <div class="input-container">
                <div class="fill-space select-container" data-action="racks">
                </div>
                <i data-lucide="chevron-down"></i>
            </div>
        </div>
    </div>

    <div class="row button-row">
        <button class="btn btn-no-border btn-cancel" type="button" data-form=".stock-transfer-form" data-overlay=".stock-transfer-overlay">Cancel</button>
        <button class="btn btn-primary">Create Rack</button>
    </div>
    <input type="hidden" name="warehouse_id" value="<?php echo $warehouseId; ?>">
</form>
<div class="page-overlay stock-transfer-overlay"></div>

