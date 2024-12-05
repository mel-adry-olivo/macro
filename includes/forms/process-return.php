<?php

require '../template-components.php';

?>

<div class="form-wrapper">
    <h1 class="form-title">Recieve Stock</h1>
    <div class="form-layout-main">
        <?php createFormSearchBoxWithSelection("Search Product"); ?>
        <div class="form-layout-row">   
            <?php createFormNumberInput("Quantity Returned", "Enter quantity returned" , true)?>
            <?php createFormDropdown("Return Reason", ["Damaged", "Defective", "Wrong Product"]) ?>
            <?php createFormButtonGroup("Process Return", "Cancel")?>
        </div>
    </div>
</div>
