<?php 

require '../includes/db-config.php';
require '../includes/template-components.php';

?>
<div class="inbound">
    <div class="inbound-header">
        <div class="inbound-title">
            <h1>Inbound</h1>
        </div>
        <div class="row">
            <?php createFormButton("Receive New Stock", "package", false, false, 'receive-stock')?>
            <?php createFormButton("Process Return", "undo-2", false , false, 'process-return')?>
            <?php createFormButton("Create Purchase Order", "calendar-arrow-up", true, false, 'purchase-order')?>
        </div>
    </div>
    <div class="inbound-content">
    </div>
</div>