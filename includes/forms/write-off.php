<?php

require '../template-components.php';

?>

<div class="form-wrapper">
    <h1 class="form-title">Inventory Write Off</h1>
    <div class="form-layout-main">
        <?php createFormSearchBoxWithSelection("Search Product"); ?>
        <div class="form-layout-row">   
            <?php createFormNumberInput("Quantity Written Off", "Enter quantity written off", true)?>
            <?php createFormDropdown("Return Reason", ["Damaged", "Expired"]) ?>
            <?php createFormButtonGroup("Confirm Write Off", "Cancel")?>
        </div>
    </div>
</div>
