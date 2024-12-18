<?php 

require '../includes/db-config.php';
require '../includes/template-components.php';

$categories = ['All', 'Fiction', 'Dystopian', 'Classic', 'Romance', 'Fantasy'];

$sql = "SELECT * FROM products";
$result = $conn->query($sql);
$products = $result->fetch_all(MYSQLI_ASSOC);

?>
<div class="products">
    <div class="products-header">
        <div class="products-title">
            <h1>Products</h1>
        </div>
        <div class="row">
            <?php createFileUpload("Import CSV", "import", false)?>
        </div>
    </div>
    <div class="list-scroll">
        <div class="products-list">
        <div class="table"> 
                <div class="table-header">
                    <div class="table-header-item" primary-item>Rack Name</div>
                    <div class="table-header-item">Category</div>
                    <div class="table-header-item">Price</div>
                    <div class="table-header-item">Supplier Name</div>
                    <div class="table-header-item">Supplier Addr.</div>
                </div>
                <div class="table-body">
                    <?php foreach($products as $product) :?>
                    <div class="table-row rack-card" data-id="$id">
                        <div class="table-row-item" primary-item>
                            <img src="<?php echo $product['image'] ?>">
                            <div class="flow">
                                <span class="name"><?php echo $product['name'] ?></span>
                            </div>
                        </div> 
                        <div class="table-row-item"><?php echo $product['category'] ?></div>
                        <div class="table-row-item">₱<?php echo $product['price'] ?></div>
                        <div class="table-row-item"><?php echo $product['supplier_name'] ?></div>
                        <div class="table-row-item"><?php echo $product['supplier_address'] ?></div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>