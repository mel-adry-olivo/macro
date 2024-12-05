<?php 

require '../includes/db-config.php';
require '../includes/db-utils.php';
require '../includes/template-components.php';

$outboundTransactions = getOutboundTransactions() ?? [];

?>
<div class="outbound">
    <div class="outbound-header">
        <div class="outbound-title">
            <h1>Outbound</h1>
        </div>
        <div class="row">
            <?php createFormButton("Sales Order", "shopping-basket", false, false, 'sales-order')?>
            <?php //createFormButton("Ship Orders", "import", false, false, 'ship-orders')?>
            <?php //createFormButton("Write Off", "minus", true, false, 'write-off')?>
        </div>
    </div>
    <div class="outbound-content">
        <div class="table outbound-table">
            <div class="table-header">
                <div class="table-header-item">Customer Name</div>
                <div class="table-header-item">Operation</div>
                <div class="table-header-item">Products</div>
                <div class="table-header-item">Total Quantity</div>
                <div class="table-header-item">Timestamp</div>
            </div>
            <div class="list-scroll">
                <div class="table-body">
                    <?php foreach ($outboundTransactions as $transaction) { ?>
                        <?php createOutboundTransactionCard($transaction) ?>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="page-overlay outbound-overlay"></div>