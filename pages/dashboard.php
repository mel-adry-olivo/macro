<?php 

require '../includes/db-config.php';
require '../includes/template-components.php';


$sql = "SELECT * FROM books";
$result = $conn->query($sql);
$books = $result->fetch_all(MYSQLI_ASSOC);

$now = date_format(new DateTime('now'), 'd-m-Y');
$availableProducts = count($books);
$totalStockValue = 0;
foreach($books as $book) {
    $totalStockValue += $book['price'];
}


$thresholdSql = "
    SELECT * FROM books 
    WHERE stock > stock_threshold 
    AND stock <= stock_threshold  + 10
    LIMIT 3";
$thresholdResult = $conn->query($thresholdSql);
$thresholdBooks = $thresholdResult->fetch_all(MYSQLI_ASSOC);

?>

<div class="dashboard">
    <div class="dashboard-card-1">
        <h2>Available Products</h2>
        <h1><?php echo $availableProducts ?></h1>
        <p>Last Updated: 27 Nov 2024</p>
    </div>
    <div class="dashboard-card-2">
        <h2>Total Sales</h2>
        <h1>-</h1>
        <p>Monthly Goal: $200,000</p>
    </div>
    <div class="dashboard-card-3">
        <h2>Total Stock Value</h2>
        <h1>₱<?php echo number_format($totalStockValue, 0, '.', ',') ?></h1>
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
            <li>Low stock: Product D</li>
            <li>New Order: #10245</li>
            <li>Stock Update Scheduled</li>
        </ul>
    </div>
    <div class="dashboard-card-7">
        <h2>Products Near Threshold</h2>
        <div class="threshold-container">
            <?php foreach($thresholdBooks as $book) : ?>
                <?php createNearThresholdProduct($book); ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>
