<?php 

require '../includes/db-config.php';
require '../includes/template-components.php';

$categories = ['All', 'Fiction', 'Dystopian', 'Classic', 'Romance', 'Fantasy'];

$sql = "SELECT * FROM books";
$result = $conn->query($sql);
$books = $result->fetch_all(MYSQLI_ASSOC);

?>


<div class="products">
    <div class="warehouse-breadcrumb">
        <?php //createButton("Products", "", false, true); ?>
    </div>
    <div class="products-header">
        <div class="products-title">
            <h1>Products</h1>
        </div>
        <div class="row">
            <?php createButton("Input Sales", "dollar-sign", false)?>
            <?php createButton("Import CSV", "import", false)?>
            <?php createButton("Add Product", "plus", true, dataForm:".product-add-form", dataOverlay:".product-add-overlay")?>
        </div>
    </div>
    <!-- <div class="products-toolbar">
        <?php //createSearchbar("Search products")?>
        <?php //createDropdown($categories, "filter") ?>
    </div> -->
    <div class="list-scroll">
        <div class="products-list">
        <div class="table"> 
                <div class="table-header">
                    <div class="table-header-item" primary-item>Rack Name</div>
                    <div class="table-header-item">Total Sales</div>
                    <div class="table-header-item">Price</div>
                    <div class="table-header-item" actions>Actions</div>
                </div>
                <div class="table-body">
                    <?php foreach($books as $book) :?>
                    <div class="table-row rack-card" data-id="$id">
                        <div class="table-row-item" primary-item>
                            <img src="<?php echo $book['image'] ?>">
                            <div class="flow">
                                <span class="name"><?php echo $book['name'] ?></span>
                                <span class="author"><?php echo $book['author'] ?></span>
                            </div>
                        </div> 
                        <div class="table-row-item">?</div>
                        <div class="table-row-item">$<?php echo $book['price'] ?></div>
                        <div class="table-row-item" actions>
                            <div class="table-actions">
                                <button class="btn-icon border rack-expand" aria-label="view">
                                    <i data-lucide="expand"></i>
                                </button>
                                <button class="btn-icon border rack-edit" aria-label="edit">
                                    <i data-lucide="edit"></i>
                                </button>
                                <button class="btn-icon border rack-delete" aria-label="delete">
                                    <i data-lucide="trash-2"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="page-overlay add-overlay"></div>
<?php require '../includes/products/product-add-form.php'; ?>