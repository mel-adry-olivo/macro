<?php 

require '../includes/db-config.php';
require '../includes/db-utils.php';
require '../includes/template-components.php';


$products = getProducts();
$availableProducts = count($products);
$totalStock = getTotalStockValue();
$transactions = getRandomTransaction();


?>

<div class="dashboard">
    <div class="dashboard-card-1">
        <h2>Available Products</h2>
        <h1><?php echo $availableProducts ?></h1>
        <p>Last Updated: 27 Nov 2024</p>
    </div>

    <div class="dashboard-card-3">
        <h2>Total Stock Value</h2>
        <h1>₱<?php echo number_format($totalStock, 0, '.', ',') ?></h1>
        <p>+2% since last month</p>
    </div>
    <div class="dashboard-card-4">
        <h2>Recent Stock Movement</h2>
        <h1>-</h1>
        <p>Items transfered in the last 30 days</p>
    </div>
    <div class="dashboard-card-5">
        <h2>Pending Orders</h2>
        <h1>-</h1>
        <p>Urgent: -</p>
    </div>
    <div class="dashboard-card-6">
        <h2>Recent Updates</h2>
        <ul>
            <!-- <li>Low stock: Product D</li>
            <li>New Order: #10245</li>
            <li>Stock Update Scheduled</li> -->
        </ul>
    </div>
    <div class="dashboard-card-7">
        <h2>Products To Reorder</h2>
        <div class="threshold-container">
            <?php //foreach($thresholdBooks as $book) : ?>
            <?php //endforeach; ?>
        </div>
    </div>
</div>
