<?php

$choices = [
    'Warehouse' => 'box'
];

$warehouseRacks = getWarehouseRacks($warehouseId);
$initalBooks = getRackBooksById($warehouseId, $warehouseRacks[0]['id']);

?>

<form action="./api/rack.php" method="POST" class="modal-form stock-transfer-form " >
    <h1 class="modal-form-title">Transfer stocks</h1>
    <div class="dropdown-container dropdown-origin selected">
        <div class="dropdown-wrapper">
            <div class="fill-space select-container gap-05" data-action="origin">
                <div class="flow fill-space">
                    <div class="legend">Origin</div>
                    <div class="row items-center">
                        <select class="dropdown-select fill-space">
                            <?php foreach($warehouseRacks as $rack) :?>
                                <option value="<?php echo $rack['id'] ?>"><?php echo $rack['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <i data-lucide="chevron-down"></i>
                    </div>
                </div>
                <div class="flow fill-space">
                    <div class="legend">Quantity</div>
                    <div class="row items-center">
                        <input type="number" name="quantity" value="0" class="input-text">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="field-group">
        <div class="table scrollable">
            <div class="table-header space-between ">
                <div class="table-header-item unflex" primary-item>Name</div>
                <div class="table-header-item">Quantity</div>
                <div class="table-header-item unflex">
                    <input type="checkbox" class="select-all-checkbox">
                </div>
            </div>
            <div class="table-body">
                <?php if(!empty($initalBooks)) : ?>
                    <?php  foreach($initalBooks as $book) { createProductRowWithQuantity($book); } ?>
                <?php else : ?>
                    <div class="table-body-item">No books in this rack</div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php createRadioGroup($choices, 'storage', 'Select where to transfer')?>
    <div class="dropdown-container dropdown-warehouse selected">
        <div class="dropdown-wrapper">
            <div class="input-container gap-05">
                <div class="fill-space select-container" data-action="warehouse">
                    <div class="flow fill-space">
                        <div class="legend">Select a warehouse</div>
                        <div class="row items-center">
                            <select class="dropdown-select fill-space">
                                <option value="">Warehouse 1</option>
                            </select>
                            <i data-lucide="chevron-down"></i>
                        </div>
                    </div>
                </div>
                <div class="fill-space select-container" data-action="warehouse">
                    <div class="flow fill-space">
                        <div class="legend">Select a rack</div>
                        <div class="row items-center">
                            <select class="dropdown-select">
                                <option value="">Rack 1</option>
                            </select>
                            <i data-lucide="chevron-down"></i>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <div class="row button-row">
        <button class="btn btn-no-border btn-cancel" type="button" data-form=".stock-transfer-form" data-overlay=".stock-transfer-overlay">Cancel</button>
        <button class="btn btn-primary">Transfer Stock</button>
    </div>
    <input type="hidden" name="warehouse_id" value="<?php echo $warehouseId; ?>">
</form>
<div class="page-overlay stock-transfer-overlay"></div>

