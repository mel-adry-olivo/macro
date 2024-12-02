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

function createButton($text, $icon = "", $filled = false, $noborder = false, $dataForm = '', $dataOverlay='', ) {
    $iconHtml = $icon ? "<i data-lucide='$icon'></i>" : "";
    $filled = $filled ? "btn-primary" : "";
    $noborder = $noborder ? "btn-no-border" : "";
    $class = strtolower(str_replace(" ", "-", $text)) . "-btn";
    $formButton = '';
    if(!empty($dataForm) && !empty($dataOverlay)) {
        $formButton = 'form-button';
    }

    echo
    <<<HTML
    <button class="btn $noborder $filled $class" data-form="$dataForm" data-overlay="$dataOverlay" $formButton>
        $iconHtml
        $text
    </button>
    HTML;
}

function createDropdown($options, $class = "") {

    $options = createDropdownOptions($options);

    echo
    <<<HTML
    <div class="dropdown dropdown-$class selected">
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
            <select class="dropdown-select">
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

    $id = $product["id"];
    $image = $product["image"];
    $name = $product["name"];
    $author = $product["author"];
    $category = $product["category"];
    $stock = $product["stock"];
    $price = $product["price"];

    echo
    <<<HTML
    <div class="table-row product-card" data-id="$id">
        <div class="table-row-item" primary-item>
            <img src="$image">
            <div class="flow">
                <span class="name">$name</span>
                <span class="author">$author</span>
            </div>
        </div>
        <div class="table-row-item">$category</div>
        <div class="table-row-item">$stock</div>
        <div class="table-row-item">₱$price</div>
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

function createSimpleProductRow($product) {

    $id = $product["id"];
    $image = $product["image"];
    $name = $product["name"];
    $author = $product["author"];

    echo
    <<<HTML
    <div class="table-row product-card" data-id="$id">
        <div class="table-row-item space-between" primary-item>
            <div class="wrapper row">
                <img src="$image">
                <div class="flow">
                    <span class="name">$name</span>
                    <span class="author">$author</span>
                </div>
            </div>
            <div class="row">
                <input type="checkbox" data-id="$id" name="product-checkbox-$id" value="$id">
            </div>
        </div>
    </div>
    HTML;
}

function createWarehouseTableRow($warehouse) {

    $id = $warehouse["id"];
    $name = $warehouse["name"];
    $address = $warehouse["address"];

    echo
    <<<HTML
    <div class="table-row warehouse-card" data-id="$id">
        <div class="table-row-item" primary-item>$name</div>
        <div class="table-row-item">$address</div>
        <div class="table-row-item" actions>
            <div class="table-actions">
                <button class="btn-icon border warehouse-expand" aria-label="view">
                    <i data-lucide="expand"></i>
                </button>
                <button class="btn-icon border warehouse-edit" aria-label="edit">
                    <i data-lucide="edit"></i>
                </button>
                <button class="btn-icon border warehouse-delete" aria-label="delete">
                    <i data-lucide="trash-2"></i>
                </button>
            </div>
        </div>
    </div>
    HTML;
}


function createRackTableRow($rack) {

    $id = $rack["id"];
    $name = $rack["name"];
    $maxCapacity = $rack["max_unit_capacity"];
    $capacityUsed = '0%';
    $lastUpdated = date_format(new DateTime($rack["last_updated"]), "d-m-Y");

    echo
    <<<HTML
    <div class="table-row rack-card" data-id="$id">
        <div class="table-row-item" primary-item>$name</div>
        <div class="table-row-item">$maxCapacity</div>
        <div class="table-row-item">$capacityUsed</div>
        <div class="table-row-item">$lastUpdated</div>
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
    HTML;
}

function createRadioGroup($array, $name, $legend, $first = true) {

    $html = '';

    foreach ($array as $key => $value) {

        $keylc = str_replace(' ', '-', strtolower($key));
        $checked = $first ? 'checked' : ''; 
        $first = false; 


        $html .= <<<HTML
        <label for="$keylc">
            <input type="radio" id="$keylc" name="$name" value="$keylc" $checked>
            <div class="btn">
                <i data-lucide="$value"></i>
                $key
            </div>
        </label>
        HTML;
    }

    echo
    <<<HTML
    <fieldset class="radio-group">
        <p class="legend">$legend</p>
        <div class="radio-group-container">
            $html
        </div>
    </fieldset>
    HTML;
}