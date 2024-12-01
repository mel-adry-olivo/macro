<?php 

require '../includes/config.php';
require '../includes/template-components.php';

$categories = ['All', 'Fiction', 'Dystopian', 'Classic', 'Romance', 'Fantasy'];

$sql = "SELECT * FROM books";
$result = $conn->query($sql);
$books = $result->fetch_all(MYSQLI_ASSOC);

?>


<div class="products">
    <div class="warehouse-breadcrumb">
        <?php createButton("Products", "", false, true); ?>
    </div>
    <div class="products-header">
        <div class="products-title">
            <h1>Products</h1>
        </div>
        <div class="row">
            <?php createButton("Import CSV", "import", false)?>
            <?php createButton("Add Product", "plus", true)?>
        </div>
    </div>
    <div class="products-toolbar">
        <?php createSearchbar("Search products")?>
        <?php createDropdown($categories, "filter") ?>
    </div>
     <div class="products-list">
        <div class="table">
            <div class="table-header">
                <div class="table-header-item" primary-item>Name</div>
                <div class="table-header-item">Category</div>
                <div class="table-header-item">Stock Level</div>
                <div class="table-header-item">Price</div>
                <div class="table-header-item" actions>Actions</div>
            </div>
            <div class="table-body">
                <?php foreach($books as $book) { createProductTableRow($book); } ?>
            </div>
        </div>
    </div>
</div>
<div class="page-overlay add-overlay"></div>
<?php require '../includes/products/product-add-form.php'; ?>