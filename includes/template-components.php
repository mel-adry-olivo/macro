<?php 

function createNearThresholdProduct($product) {

    $productName = $product["name"];
    $productId = $product["id"];
    $stock = $product['stock'];
    $threshold = $product['stock_threshold'];
    $units = $stock - $threshold;

    echo 
    <<< HTML
    <div class="near-threshold-card">
        <div class="text-wrapper">
            <span class="product-id">#PID00$productId</span>
            <span class="product-name">$productName</span>
            <span class="units">$units units until threshold</span>
        </div>
    </div>
    HTML;
}

function createNotificationCard($product) {
    
}

function createSearchbar($placeholder = "Search") {
    echo
    <<<HTML
    <div class="searchbar">
        <div class="btn-icon icon">
            <i data-lucide="search"></i>
        </div>
        <input type="text" placeholder="$placeholder">
    </div>
    HTML;
}

function createButton($text, $icon = "", $filled = false) {
    $iconHtml = $icon ? "<i data-lucide='$icon'></i>" : "";
    $filled = $filled ? "btn-primary" : "";
    $class = strtolower(str_replace(" ", "-", $text)) . "-btn";

    echo
    <<<HTML
    <button class="btn $filled $class">
        $iconHtml
        $text
    </button>
    HTML;
}

function createDropdown($options, $class = "") {

    $options = createDropdownOptions($options);

    echo
    <<<HTML
    <div class="dropdown dropdown-$class">
        <select>
            $options
        </select>
        <i data-lucide="chevron-down"></i>
    </div>
    HTML;
}

function createDropdownWithLabel($label, $options, $class = "") {

    $options = createDropdownOptions($options);

    echo
    <<<HTML
    <div class="dropdown-wrapper dropdown-$class">
        <label class="dropdown-label">$label</label>
        <div class="dropdown">
            <select>
                $options
            </select>
            <i data-lucide="chevron-down"></i>
        </div>
    </div>
    HTML;
}

function createDropdownOptions($options) {
    $html = "";
    foreach ($options as $option) {
        $html .= "<option value='$option'>$option</option>";
    }
    return $html;
}

function createProductTableRow($product) {

    $image = $product["image"];
    $name = $product["name"];
    $author = $product["author"];
    $category = $product["category"];
    $stock = $product["stock"];
    $price = $product["price"];

    echo
    <<<HTML
    <div class="table-row">
        <div class="table-row-item" primary-item>
            <img src="$image">
            <div class="flow">
                <span class="name">$name</span>
                <span class="author">$author</span>
            </div>
        </div>
        <div class="table-row-item">$category</div>
        <div class="table-row-item">$stock</div>
        <div class="table-row-item">$$price</div>
        <div class="table-row-item" actions>
            <div class="table-actions">
                <button class="btn-icon border" aria-label="view">
                    <i data-lucide="expand"></i>
                </button>
                <button class="btn-icon border" aria-label="edit">
                    <i data-lucide="edit"></i>
                </button>
                <button class="btn-icon border" aria-label="delete">
                    <i data-lucide="trash-2"></i>
                </button>
            </div>
        </div>
    </div>
    HTML;
}

function createWarehouseTableRow($warehouse) {

    $name = $warehouse["name"];
    $address = $warehouse["address"];

    echo
    <<<HTML
    <div class="table-row">
        <div class="table-row-item" primary-item>$name</div>
        <div class="table-row-item">$address</div>
        <div class="table-row-item" actions>
            <div class="table-actions">
                <button class="btn-icon border" aria-label="view">
                    <i data-lucide="expand"></i>
                </button>
                <button class="btn-icon border" aria-label="edit">
                    <i data-lucide="edit"></i>
                </button>
                <button class="btn-icon border" aria-label="delete">
                    <i data-lucide="trash-2"></i>
                </button>
            </div>
        </div>
    </div>
    HTML;

}