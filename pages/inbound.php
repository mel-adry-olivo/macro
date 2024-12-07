<?php 

require '../includes/db-config.php';
require '../includes/db-utils.php';
require '../includes/template-components.php';

$inboundTransactions = getInboundTransactions() ?? [];

?>
<div class="inbound">
    <div class="inbound-header">
        <div class="inbound-title">
            <h1>Inbound</h1>
        </div>
        <div class="row">
            <?php createFormButton("Receive New Stock", "package", false, false, 'receive-stock')?>
        </div>
    </div>
    <div class="inbound-content">
        <div class="table inbound-table">
            <div class="table-header">
                <div class="table-header-item" primary-item>Warehouse</div>
                <div class="table-header-item">Operation</div>
                <div class="table-header-item">Products</div>
                <div class="table-header-item">Total Quantity</div>
                <div class="table-header-item">Timestamp</div>
            </div>
            <div class="list-scroll">
                <div class="table-body">
                    <?php if (!empty($inboundTransactions)) : ?>
                        <?php foreach ($inboundTransactions as $transaction) { ?>
                            <?php createInboundTransactionCard($transaction) ?>
                        <?php } ?>
                    <?php else : ?>
                        <div class="table-body-item no-data">No inbound transactions</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>