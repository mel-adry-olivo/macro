
              <?php

require '../template-components.php';

?>

<div class="form-wrapper">
    <h1 class="form-title">Add Product</h1>
    <div class="form-layout-main">
        <div class="form-image-container"></div>
        <div class="form-layout-row">
            <div class="form-group">
                <span class="form-group-label">Image Upload</span>
                <div class="form-image-chooser">
                    <label for="form-image-input">
                    <i data-lucide="upload"></i>
                    Choose Image
                    </label>
                    <input type="file" id="form-image-input" class="form-image-input" accept="image/*">
                </div>
            </div>
        </div>
        <div class="form-layout-row">   
            <?php createFormTextInput("Product Name", "Enter product name") ?>
            <?php createFormTextInput("Category", "Enter product category") ?>
            <?php createFormNumberInput("Price", "Enter product price")?>
            <?php createFormNumberInput("Reorder Level", "Enter product reorder level")?>
        </div>
        <div class="form-layout-row">
            <?php createFormTextInput("Supplier Name", "Enter supplier name")?>
            <?php createFormTextInput("Supplier Address", "Enter supplier address")?>
        </div>
        <div class="form-layout-row">
            <?php createFormButtonGroup("Add Product", "Cancel", false)?>
        </div>
    </div>
</div>
