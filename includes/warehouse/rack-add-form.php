<form action="./api/rack.php" 
    method="POST" 
    class="modal-form warehouse-add-rack-form"  
    data-id="<?php echo $warehouseId; ?>">
    
    <h1 class="modal-form-title">Create a rack</h1>
    <div class="flow flex-1">
        <div class="field-group">
            <label for="rack-name">Rack Name</label>
            <input type="text" name="rack-name">
        </div>
        <div class="field-group">
            <label for="rack-capacity">Units Capacity</label>
            <input 
                type="number" 
                name="rack-capacity" 
                value="0" 
                onInput="event.target.value = event.target.value.replace(/[^0-9]/g, '')" 
                min="0" 
                step="1">
        </div>
    </div>
    <div class="row button-row">
        <button class="btn btn-no-border btn-cancel rack" type="button">Cancel</button>
        <button class="btn btn-primary">Create Rack</button>
    </div>
    <input type="hidden" name="warehouse_id" value="<?php echo $warehouseId; ?>">
</form>
<div class="page-overlay add-rack-overlay"></div>


