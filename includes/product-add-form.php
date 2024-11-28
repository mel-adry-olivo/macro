<form action="#" method="POST" class="modal-form product__add-form">
    <h1 class="modal-form-title">Add a product</h1>
    <div class="flow">
        <div class="image-container"></div>
        <div class="file-chooser">
            <label for="product-image">
                <i data-lucide="upload"></i>
                Choose Image
            </label>
            <input type="file" id="product-image" class="image-chooser" accept="image/*">
        </div>
    </div>
    <div class="row flex-1">
        <div class="field-group">
            <label for="product-name">Product Name</label>
            <input type="text" name="product-name">
        </div>
        <div class="field-group">
            <label for="product-name">Author</label>
            <input type="text" name="product-author">
        </div>
    </div>
    <div class="row flex-1">
        <?php createDropdownWithLabel("Category", $categories)?>
        <div class="field-group">
            <label for="product-price">Price</label>
            <input 
                type="number" 
                name="product-price" 
                value="0" 
                onInput="event.target.value = event.target.value.replace(/[^0-9]/g, '')" 
                min="0" 
                step="1">
        </div>
    </div>
    <div class="row button-row">
        <button class="btn btn-cancel" type="button">Cancel</button>
        <button class="btn btn-primary" type="submit">Add Product</button>
    </div>
    <input type="hidden" name="action" value="create">
</form>
<div class="page-overlay add-product-overlay"></div>