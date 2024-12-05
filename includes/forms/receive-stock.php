<?php

require '../template-components.php';

?>

<form class="form-wrapper">
    <h1 class="form-title">Receive Stock</h1>
    <div class="form-layout-main">
        <?php createFormSearchBoxWithSelection("Search Product", "Selected Product"); ?>
        <div class="form-layout-row">
            <?php createFormNumberInput("Quantity Received", "Enter quantity received", true)?>
            <?php createFormButtonGroup("Confirm Receipt", "Cancel")?>
        </div>
    </div>
</form>
