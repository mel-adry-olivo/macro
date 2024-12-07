<?php 

function createFormButton($text, $icon = "", $filled = false, $noborder = false, $dataForm = '') {
    $iconHtml = $icon ? "<i data-lucide='$icon'></i>" : "";
    $filled = $filled ? "btn-primary" : "";
    $noborder = $noborder ? "btn-no-border" : "";
    $class = strtolower(str_replace(" ", "-", $text)) . "-btn";

    echo
    <<<HTML
    <button class="btn $noborder $filled $class" data-form="$dataForm" btn-form>
        $iconHtml
        $text
    </button>
    HTML;
}

function createFileUpload($text, $icon = "", $filled = false, $noborder = false, $dataForm = '') {
    $iconHtml = $icon ? "<i data-lucide='$icon'></i>" : "";
    $filled = $filled ? "btn-primary" : "";
    $noborder = $noborder ? "btn-no-border" : "";
    $class = strtolower(str_replace(" ", "-", $text)) . "-btn";

    echo
    <<<HTML
    <label class="btn $noborder $filled $class" for="product-csv">
        $iconHtml
        $text
        <input type="file" accept=".csv" hidden id="product-csv"/>
    </label>
    HTML;
}


function createInboundTransactionCard($transaction) {
    
    $warehouse = $transaction["warehouse"];
    $operation = $transaction["operation"];
    $products = $transaction["products"];
    $quantity = $transaction["quantity"];
    $timestamp = $transaction["timestamp"];

    echo
    <<<HTML
    <div class="table-row">
        <div class="table-row-item" primary-item>$warehouse</div>
        <div class="table-row-item">$operation</div>
        <div class="table-row-item">$products</div>
        <div class="table-row-item">$quantity</div>
        <div class="table-row-item">$timestamp</div>
    </div>
    HTML;
}

function createOutboundTransactionCard($transaction) {
    
    $warehouse = $transaction["warehouse"];
    $operation = $transaction["operation"];
    $products = $transaction["products"];
    $quantity = $transaction["quantity"];
    $timestamp = $transaction["timestamp"];

    echo
    <<<HTML
    <div class="table-row">
        <div class="table-row-item" primary-item>$warehouse</div>
        <div class="table-row-item">$operation</div>
        <div class="table-row-item">$products</div>
        <div class="table-row-item">$quantity</div>
        <div class="table-row-item">$timestamp</div>
    </div>
    HTML;
}

function createProductTableRow($product) {

    $id = $product["product_id"];
    $image = $product["product_image"];
    $name = $product["product_name"];
    $category = $product["product_category"];
    $stock = $product["stock_quantity"];
    $rackName = $product["rack_id"] ?? 'Unassigned'; 
    $price = $product["price"] ?? 'N/A';

    echo
    <<<HTML
    <div class="table-row product-card" data-id="$id">
        <div class="table-row-item" primary-item>
            <img src="$image" alt="$name">
            <div class="flow">
                <span class="name" data-name="name">$name</span>
            </div>
        </div>
        <div class="table-row-item" quantity data-name="stock">$stock</div>
        <div class="table-row-item" data-name="rack">$rackName</div>
        <div class="table-row-item" data-name="price">₱$price</div>
    </div>
    HTML;
}

function createWarehouseTableRow($warehouse) {

    $id = $warehouse["id"];
    $name = $warehouse["name"];
    $address = $warehouse["address"];
    $totalStocks = $warehouse["total_stock"];
    $capacity = $warehouse["max_unit_capacity"];

    echo
    <<<HTML
    <div class="table-row warehouse-card" data-id="$id">
        <div class="table-row-item" primary-item>$name</div>
        <div class="table-row-item">$address</div>
        <div class="table-row-item">$totalStocks</div>
        <div class="table-row-item">$capacity</div>
        <div class="table-row-item" actions>
            <div class="table-actions">
                <button class="btn-icon border warehouse-expand" aria-label="view">
                    <i data-lucide="expand"></i>
                </button>

                <button class="btn-icon border warehouse-delete" aria-label="delete">
                    <i data-lucide="trash-2"></i>
                </button>
            </div>
        </div>
    </div>
    HTML;
}

function createFormSearchBoxWithSelection($label = "Search Box", $placeholder = "You can search here") {
    echo
    <<<HTML
        <div class="form-layout-row">
            <div class="form-group">
            <span class="form-group-label">Search Box</span>
            <div class="form-search-box">
                <i data-lucide="search"></i>
                <input type="text" class="form-text-input" placeholder="You can search here" search/>
                <div class="form-search-results"></div>
            </div>
            </div>
        </div>
        
        <div class="form-layout-row">
            <div class="form-group">
                <span class="form-group-label">Search Selection</span>
                <div class="form-search-selection"></div>
            </div>
        </div>
    HTML;
}

function createFormTextInput($label = "Text Input", $placeholder = "You can type here") {

    $identifier = str_replace(' ', '-', strtolower($label));

    echo
    <<<HTML
        <div class="form-group">
            <span class="form-group-label">$label</span>
            <input type="text" class="form-text-input" placeholder="$placeholder" data-identifier="$identifier"/>
        </div>
    HTML;
}

function createFormNumberInput($label = "Number Input", $placeholder = "You can only type numbers here", $allowCommas = false) {

    if ($allowCommas) {
        echo
        <<<HTML
            <div class="form-group">
                <span class="form-group-label">$label</span>
                <input type="text" class="form-text-input" placeholder="$placeholder" numbers allow-comma/>
            </div>
        HTML;
        return;
    }
    
    echo
    <<<HTML
        <div class="form-group">
            <span class="form-group-label">$label</span>
            <input type="text" class="form-text-input" placeholder="$placeholder" numbers/>
        </div>
    HTML;
}

function createFormButtonGroup($submitLabel = "Submit", $cancelLabel = "Cancel", $space = true) {

    if ($space) {
        $spacer = '&nbsp;'; 
    } else {
        $spacer = '';
    }
    echo
    <<<HTML
        <div class="form-group">
            <span class="form-group-label">$spacer</span>
            <button class="btn btn-primary form-button" outlined cancel>
                <i data-lucide="x"></i>
                $cancelLabel
            </button>
        </div>
        <div class="form-group">
            <span class="form-group-label">$spacer</span>
            <button class="btn btn-primary form-button" submit>
                <i data-lucide="check"></i>
                $submitLabel
            </button>
        </div>
    HTML;
}

function createFormDropdown($label = "Dropdown", $options = []) {
    
    $optionsHtml = "";
    foreach ($options as $option) {
        $optionsHtml .= "<option value='$option'>$option</option>";
    }

    echo
    <<<HTML
    <div class="form-group">
        <span class="form-group-label">$label</span>
        <div class="form-select-wrapper">
            <select class="form-select-input">
            $optionsHtml
            </select>
            <i data-lucide="chevron-down"></i>
        </div>
    </div>
    HTML;
}

