import { navigateTo } from './router.js';
import { showForm, hideForm, newShowForm, hideOverlay } from './utils.js';
import { config } from './config.js';
import { showSnackbar } from './components/snackbar.js';
import {
  getReceiveStockData,
  submitStockReceiveData,
  getSalesOrderData,
  submitSalesOrderData,
  getWarehouseData,
  submitWarehouseData,
  getTransferStockData,
  submitTransferStockData,
  getAdjustStockData,
  submitAdjustStockData,
  importCsv,
} from '../includes/forms/form-handler.js';

// forms
document.querySelector('.container').addEventListener('click', (e) => {
  if (e.target.matches('.nav-item')) {
    document.querySelector('.nav-item.active').classList.remove('active');
    e.target.classList.add('active');
  }

  if (e.target.matches('.form-button[cancel]')) {
    e.preventDefault();
    hideOverlay();
  }

  if (e.target.matches('[btn-form]')) {
    newShowForm(e.target.dataset.form);
  }

  if (e.target.matches('.form-button[submit]')) {
    e.preventDefault();
    const form = e.target.closest('.form-wrapper');
    const title = form.querySelector('.form-title').textContent;

    if (title === 'Receive Stock') {
      const data = getReceiveStockData();
      submitStockReceiveData(data);
      hideOverlay();
    }

    if (title === 'Sales Order') {
      const data = getSalesOrderData();
      submitSalesOrderData(data);
      hideOverlay();
    }

    if (title === 'Add Warehouse') {
      const data = getWarehouseData();
      submitWarehouseData(data);
      hideOverlay();
    }

    if (title === 'Transfer Stock') {
      const data = getTransferStockData();
      submitTransferStockData(data);
      hideOverlay();
    }

    if (title === 'Adjust Stock') {
      const data = getAdjustStockData();
      submitAdjustStockData(data);
      hideOverlay();
    }
  }

  //********************************************* */

  // TODO: Warehouse Edit
  if (e.target.matches('.warehouse-edit')) {
    const message = 'This will show edit form where you can edit warehouse data like name and address.';
    showSnackbar('Function', message, 2500);
  }

  // TODO: Warehouse Delete
  if (e.target.matches('.warehouse-delete')) {
    const message = 'This will delete warehouse and all racks inside it.';
    showSnackbar('Function', message, 2500);
  }

  // TODO: Product Edit
  if (e.target.matches('.product-edit')) {
    const message = 'This will show edit form where you can edit product data like name, price, and availability.';
    showSnackbar('Function', message, 2500);
  }

  if (e.target.matches('.table-row.product-card')) {
    const checkbox = e.target.querySelector('input[type="checkbox"]');

    if (checkbox) {
      checkbox.checked = !checkbox.checked;
    }
  }

  //* Rack Delete
  if (e.target.matches('.rack-delete')) {
    if (confirm('Are you sure you want to delete this rack?')) {
      const rackId = e.target.closest('.rack-card').dataset.id;
      fetch(config.rackApiUrl + '?action=delete&rackId=' + rackId, { method: 'POST' });
      e.target.closest('.rack-card').remove();
    }
  }
});

document.querySelector('.container').addEventListener('change', async (e) => {
  // * Linked Product Form Dropdown
  if (e.target.matches('.link-product-form .dropdown-select')) {
    const selectedValue = e.target.value;
    const warehouseId = document.querySelector('.warehouses-detail').dataset.id;
    const response = await fetch(config.linkedProductApiUrl + selectedValue + '&warehouse_id=' + warehouseId);
    const data = await response.text();
    const container = e.target.closest('.link-product-form').querySelector('.table-body');
    container.innerHTML = data;
  }

  // * Add Product Form Image Chooser
  if (e.target.matches('.image-chooser')) {
    const imageContainer = document.querySelector('.image-container');
    const file = e.target.files[0];
    const reader = new FileReader();

    reader.onload = () => {
      const image = new Image();
      image.src = reader.result;
      imageContainer.innerHTML = '';
      imageContainer.appendChild(image);
      imageContainer.style.display = 'block';
    };
    reader.readAsDataURL(file);
  }

  // TODO: Import CSV
  if (e.target.matches('#product-csv')) {
    importCsv();
  }
});
