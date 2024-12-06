import { productsMapper, insertProductsToDatabase } from '/macro/js/csv-parser.js';
import { showSnackbar } from '/macro/js/components/snackbar.js';

// * STOCK RECEIVE
export function getReceiveStockData() {
  const warehouseName = document.querySelector('.form-select-input').value;
  const quantityReceived = document.querySelector('.form-text-input[numbers]').value;
  const searchSelection = document.querySelector('.form-search-selection');
  let selection = [];
  let items = 0;

  if (searchSelection) {
    Array.from(searchSelection.children).forEach((item) => {
      selection.push(item.textContent);
    });

    items = selection.length;
  }

  if (items === 0) {
    showSnackbar('Error', 'Please select at least one item', 2500);
    return;
  }

  const quantityArray = quantityReceived.split(',').map(Number).filter(Boolean);

  if (quantityArray.length !== items) {
    showSnackbar('Error', 'Quantity and selection count must match!', 2500);
    return;
  }

  const data = {
    warehouse: warehouseName,
    selection,
    quantity: quantityArray,
  };

  // sample data = {"warehouse":"Default Warehouse","selection":["1984 ","To Kill a Mockingbird "],"quantity":[20,30]}
  return data;
}
export async function submitStockReceiveData(stockData) {
  if (stockData) {
    try {
      const response = await fetch('/macro/api/receive-stock.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(stockData),
      });

      const result = await response.json();

      if (response.ok) {
        showSnackbar('Success', 'Stock received successfully!', 2500);
        await logStockReceiveData(stockData);
      } else {
        showSnackbar('Error', result.error || 'An error occurred.', 2500);
      }
    } catch (error) {
      showSnackbar('Error', 'Failed to connect to the server.', 2500);
    }
  }
}

// * SALES ORDER
export function getSalesOrderData() {
  const warehouseName = document.querySelector('.form-select-input').value;
  const customerName = document.querySelector('.form-text-input[placeholder="Enter customer name"]').value;
  const quantitySold = document.querySelector('.form-text-input[numbers]').value;
  const searchSelection = document.querySelector('.form-search-selection');
  let selection = [];
  let items = 0;

  if (searchSelection) {
    Array.from(searchSelection.children).forEach((item) => {
      selection.push(item.textContent);
    });

    items = selection.length;
  }

  if (items === 0) {
    showSnackbar('Error', 'Please select at least one item', 2500);
    return;
  }

  const quantityArray = quantitySold.split(',').map(Number).filter(Boolean);

  if (quantityArray.length !== items) {
    showSnackbar('Error', 'Quantity and selection count must match!', 2500);
    return;
  }

  const data = {
    warehouse: warehouseName,
    customerName: customerName,
    selection,
    quantity: quantityArray,
  };

  // sample data = {"customerName":"Mel Adry","selection":["1984 "],"quantity":[2]}
  return data;
}

export async function submitSalesOrderData(salesOrderData) {
  if (salesOrderData) {
    try {
      const response = await fetch('/macro/api/sales-order.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(salesOrderData),
      });

      const result = await response.json();

      if (response.ok) {
        showSnackbar('Success', 'Sales order created successfully!', 2500);
        await logSalesOrderData(salesOrderData);
      } else {
        showSnackbar('Error', result.error || 'An error occurred.', 2500);
      }
    } catch (error) {
      showSnackbar('Error', 'Failed to connect to the server.', 2500);
    }
  }
}

// * ADD WAREHOUSE
export function getWarehouseData() {
  const warehouseName = document.querySelector('.form-text-input[placeholder="Enter warehouse name"]').value;
  const warehouseAddress = document.querySelector('.form-text-input[placeholder="Enter warehouse address"]').value;
  const warehouseCapacity = document.querySelector('.form-text-input[numbers]').value;

  if (!warehouseName || !warehouseAddress || !warehouseCapacity) {
    showSnackbar('Error', 'Please fill in all required fields', 2500);
    return;
  }

  const data = {
    name: warehouseName,
    address: warehouseAddress,
    capacity: warehouseCapacity,
  };

  return data;
}
export async function submitWarehouseData(warehouseData) {
  if (warehouseData) {
    try {
      const response = await fetch('/macro/api/warehouse.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(warehouseData),
      });

      const result = await response.text();

      if (response.ok) {
        showSnackbar('Success', 'Warehouse created successfully!', 2500);
        const warehouses = document.querySelector('.warehouses .table-body');
        warehouses.innerHTML += result;
        lucide.createIcons();
      } else {
        showSnackbar('Error', result.error || 'An error occurred.', 2500);
      }
    } catch (error) {
      showSnackbar('Error', 'Failed to connect to the server.', 2500);
    }
  }
}

// * TRANSFER STOCK
export function getTransferStockData() {
  const currentWarehouse = document.querySelector('.warehouses-title').textContent.trim();
  const warehouseName = document.querySelector('.form-select-input').value.trim();

  if (warehouseName == currentWarehouse) {
    showSnackbar('Error', 'Please select a different warehouse', 2500);
    return;
  }

  const quantityReceived = document.querySelector('.form-text-input[numbers]').value;
  const searchSelection = document.querySelector('.form-search-selection');
  let selection = [];
  let items = 0;

  if (searchSelection) {
    Array.from(searchSelection.children).forEach((item) => {
      selection.push(item.textContent);
    });

    items = selection.length;
  }

  if (items === 0) {
    showSnackbar('Error', 'Please select at least one item', 2500);
    return;
  }

  const quantityArray = quantityReceived.split(',').map(Number).filter(Boolean);

  if (quantityArray.length !== items) {
    showSnackbar('Error', 'Quantity and selection count must match!', 2500);
    return;
  }

  const data = {
    warehouseSource: currentWarehouse,
    warehouseDestination: warehouseName,
    selection,
    quantity: quantityArray,
  };

  // sample data = {"warehouse":"Default Warehouse","selection":["1984 ","To Kill a Mockingbird "],"quantity":[20,30]}
  return data;
}

// * EDIT WAREHOUSE PRODUCT
export function getAdjustStockData(card) {
  const currentWarehouse = document.querySelector('.warehouses-title').textContent.trim();
  const quantityReceived = document.querySelector('.form-text-input[numbers]').value;
  const searchSelection = document.querySelector('.form-search-selection');
  let selection = [];
  let items = 0;

  if (searchSelection) {
    Array.from(searchSelection.children).forEach((item) => {
      selection.push(item.textContent);
    });

    items = selection.length;
  }

  if (items === 0) {
    showSnackbar('Error', 'Please select at least one item', 2500);
    return;
  }

  const quantityArray = quantityReceived.split(',').map(Number).filter(Boolean);

  if (quantityArray.length !== items) {
    showSnackbar('Error', 'Quantity and selection count must match!', 2500);
    return;
  }

  const data = {
    warehouse: currentWarehouse,
    selection,
    quantity: quantityArray,
  };

  // sample data = {"warehouse":"Default Warehouse","selection":["1984 ","To Kill a Mockingbird "],"quantity":[20,30]}
  return data;
}
export async function submitAdjustStockData(adjustStockData) {
  if (adjustStockData) {
    try {
      const response = await fetch('/macro/api/adjust-stock.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(adjustStockData),
      });

      const result = await response.json();

      if (response.ok) {
        result.adjustments.forEach(async (adjustment) => {
          const productId = adjustment.productId;
          const adjustmentType = adjustment.adjustmentType;
          const adjustmentChange = adjustment.adjustmentChange;

          const productElement = document.querySelector(`.product-card[data-id="${productId}"]`);
          if (productElement) {
            const currentQuantityElement = productElement.querySelector('[quantity]');
            let currentQuantity = parseInt(currentQuantityElement.innerText, 10);
            let newQuantity;

            if (adjustmentType === 'inbound') {
              newQuantity = currentQuantity + adjustmentChange;
              await logInboundAdjustment(adjustStockData, adjustment.productName, adjustmentChange);
            } else if (adjustmentType === 'outbound') {
              newQuantity = currentQuantity - adjustmentChange;
              await logOutboundAdjustment(adjustStockData, adjustment.productName, adjustmentChange);
            }

            currentQuantityElement.innerText = newQuantity;
          }
        });

        showSnackbar('Success', 'Product updated successfully!', 2500);
      } else {
        showSnackbar('Error', result.error || 'An error occurred.', 2500);
      }
    } catch (error) {
      showSnackbar('Error', 'Failed to connect to the server.', 2500);
    }
  }
}

export async function submitTransferStockData(transferStockData) {
  if (transferStockData) {
    try {
      const response = await fetch('/macro/api/transfer-stock.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(transferStockData),
      });

      const result = await response.json();

      if (response.ok) {
        showSnackbar('Success', 'Warehouse created successfully!', 2500);
        await logOutboundTransfer(transferStockData);
        await logInboundTransfer(transferStockData);

        const productCard = document.querySelector(`.product-card[data-id="${result.id}"`);

        productCard.querySelector('[quantity]').textContent = result.quantity;
      } else {
        showSnackbar('Error', result.error || 'An error occurred.', 2500);
      }
    } catch (error) {
      showSnackbar('Error', 'Failed to connect to the server.', 2500);
    }
  }
}

// * LOGGING
async function logInboundAdjustment(adjustStockData, name, change) {
  const warehouseName = adjustStockData.warehouse.trim();
  const operation = 'Stock Adjustment';

  const logData = {
    warehouse: warehouseName,
    operation: operation,
    productNames: name,
    quantity: change,
  };

  try {
    const response = await fetch('/macro/api/log-inbound.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(logData),
    });
  } catch (error) {
    console.error('Error logging inbound transaction:', error);
    console.error('In logInboundTransfer:', error);
    showSnackbar('Error', 'Failed to log inbound transfer.', 2500);
  }
}
async function logOutboundAdjustment(adjustStockData, name, change) {
  const warehouseName = adjustStockData.warehouse.trim();
  const operation = 'Stock Adjustment';

  const logData = {
    warehouse: warehouseName,
    operation: operation,
    products: name,
    quantity: change,
  };

  try {
    const response = await fetch('/macro/api/log-outbound.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(logData),
    });
  } catch (error) {
    console.error('Error logging inbound transaction:', error);
    console.error('In logInboundTransfer:', error);
    showSnackbar('Error', 'Failed to log inbound transfer.', 2500);
  }
}
async function logStockReceiveData(stockData) {
  const warehouseName = stockData.warehouse.trim();
  const operation = 'Stock Receive';
  const productNames = stockData.selection.map((name) => name.trim()).join(', ');
  const totalQuantity = stockData.quantity.reduce((total, quantity) => total + quantity, 0);

  const data = {
    warehouse: warehouseName,
    operation,
    quantity: totalQuantity,
    productNames,
  };

  const response = await fetch('/macro/api/log-inbound.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify(data),
  });

  if (!response.ok) {
    throw new Error(response.statusText);
  }

  const result = await response.text();

  const tableBody = document.querySelector('.inbound-content .table-body');
  const noData = tableBody.querySelector('.no-data');

  if (noData) {
    noData.remove();
  }

  tableBody.insertAdjacentHTML('afterbegin', result);
  showSnackbar('Success', 'Log entry created successfully!', 2500);
}
async function logSalesOrderData(salesOrderData) {
  const warehouse = salesOrderData.warehouse.trim();
  const operation = 'Sales Order';
  const productNames = salesOrderData.selection.map((name) => name.trim()).join(', ');
  const totalQuantity = salesOrderData.quantity.reduce((total, quantity) => total + quantity, 0);

  const data = {
    warehouse: warehouse,
    operation: operation,
    quantity: totalQuantity,
    products: productNames,
  };

  try {
    const response = await fetch('/macro/api/log-outbound.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(data),
    });

    if (!response.ok) {
      throw new Error(response.statusText);
    }

    const result = await response.text();

    if (response.ok) {
      const tableBody = document.querySelector('.outbound-content .table-body');
      const noData = tableBody.querySelector('.no-data');

      if (noData) {
        noData.remove();
      }

      tableBody.insertAdjacentHTML('afterbegin', result);
      showSnackbar('Success', 'Log entry created successfully!', 2500);
    }
  } catch (error) {
    console.error('Error logging outbound transaction:', error);
    showSnackbar('Error', 'Failed to log the outbound transaction.', 2500);
  }
}
async function logOutboundTransfer(data) {
  const logData = {
    warehouse: data.warehouseSource,
    operation: 'Stock Transfer Out',
    products: data.selection.map((name) => name.trim()).join(', '),
    quantity: data.quantity.reduce((total, qty) => total + qty, 0),
  };

  try {
    const response = await fetch('/macro/api/log-outbound.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(logData),
    });
  } catch (error) {
    console.error('In logOutboundTransfer:', error);
    showSnackbar('Error', 'Failed to log outbound transfer.', 2500);
  }
}
async function logInboundTransfer(data) {
  const logData = {
    warehouse: data.warehouseDestination,
    operation: 'Stock Transfer In',
    productNames: data.selection.map((name) => name.trim()).join(', '),
    quantity: data.quantity.reduce((total, qty) => total + qty, 0),
  };

  try {
    const response = await fetch('/macro/api/log-inbound.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(logData),
    });
  } catch (error) {
    console.error('Error logging inbound transaction:', error);
    console.error('In logInboundTransfer:', error);
    showSnackbar('Error', 'Failed to log inbound transfer.', 2500);
  }
}

export function importCsv() {
  const fileInput = document.getElementById('product-csv');
  const file = fileInput.files[0];

  if (!file) {
    alert('Please select a file.');
    return;
  }

  const reader = new FileReader();

  reader.onload = async function (event) {
    const csvData = event.target.result;
    const parsedData = parseCSV(csvData);
    const products = productsMapper(parsedData);

    await insertProductsToDatabase(products);
  };

  reader.onerror = function (event) {
    alert('Error reading file: ' + event.target.error);
  };

  reader.readAsText(file);
}

function parseCSV(csvData) {
  const rows = csvData.split('\n');
  const result = [];

  for (let i = 0; i < rows.length; i++) {
    const columns = rows[i].split(',');
    result.push(columns);
  }

  return result;
}
