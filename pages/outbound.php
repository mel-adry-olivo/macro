<?php 

require '../includes/db-config.php';
require '../includes/template-components.php';

?>
<div class="outbound">
    <div class="outbound-header">
        <div class="outbound-title">
            <h1>Outbound</h1>
        </div>
        <div class="row">
            <?php createFormButton("Sales Order", "shopping-basket", false, false, 'sales-order')?>
            <?php createFormButton("Ship Orders", "import", false, false, 'ship-orders')?>
            <?php createFormButton("Write Off", "minus", true, false, 'write-off')?>
        </div>
    </div>
    <div class="outbound-content">

    </div>
</div>
<div class="page-overlay outbound-overlay"></div>