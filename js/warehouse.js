import config from '../config.js';
import { selectContent, contentArea, loadResources } from './contentNav.js';
import { showForm, hideForm } from './utils.js';

export function initWarehousesPage() {
  const warehouseCards = document.querySelectorAll('.warehouse-card');
  warehouseCards.forEach((card) => {
    card.addEventListener('click', (e) => {
      if (e.target.closest('.warehouse-expand')) {
        expandWarehouse(card.dataset.id);
      }
    });
  });

  window.onload = () => {};
}

export function initWarehouseDetailPage() {
  initRack();

  const backButton = document.querySelector('.back-btn');
  const rackAddForm = document.querySelector('.warehouse-add-rack-form');
  const rackAddOverlay = document.querySelector('.add-rack-overlay');
  const createRackButton = document.querySelector('.create-rack-btn');
  const rackAddCancel = document.querySelector('.btn-cancel.rack');

  const linkProductButton = document.querySelector('.link-product-btn');
  const linkProductForm = document.querySelector('.link-product-form');
  const linkProductOverlay = document.querySelector('.link-product-overlay');
  const linkProductCancel = document.querySelector('.btn-cancel.link');
  const selectAllCheckbox = document.querySelector('.select-all-checkbox');
  const rowCheckboxes = document.querySelectorAll('.table-body input[type="checkbox"]');
  const dropDown = document.querySelector('.link-product-form .dropdown-select');

  linkProductButton.addEventListener('click', () => {
    showForm(linkProductForm, linkProductOverlay);
  });

  linkProductCancel.addEventListener('click', () => {
    hideForm(linkProductForm, linkProductOverlay);
  });

  createRackButton.addEventListener('click', () => {
    showForm(rackAddForm, rackAddOverlay);
  });

  rackAddCancel.addEventListener('click', () => {
    hideForm(rackAddForm, rackAddOverlay);
  });

  backButton.addEventListener('click', () => {
    selectContent('warehouses');
  });

  selectAllCheckbox.addEventListener('change', function () {
    rowCheckboxes.forEach(function (checkbox) {
      checkbox.checked = selectAllCheckbox.checked;
    });
  });

  rowCheckboxes.forEach(function (checkbox) {
    checkbox.addEventListener('change', function () {
      const allChecked = Array.from(rowCheckboxes).every((checkbox) => checkbox.checked);
      selectAllCheckbox.checked = allChecked;
    });
  });

  dropDown.addEventListener('change', async () => {
    const selectedValue = dropDown.value;
    const response = await fetch(
      config.linkedProductApiUrl + selectedValue + '&warehouse_id=' + getWarehouseId(),
    );
    const data = await response.text();
    const container = linkProductForm.querySelector('.table-body');
    container.innerHTML = data;
  });

  rackAddForm.addEventListener('submit', async (e) => {
    e.preventDefault();

    const formData = new FormData(rackAddForm);
    const response = await fetch(config.rackApiUrl + '?action=create', {
      method: 'POST',
      body: JSON.stringify(Object.fromEntries(formData)),
    });

    const data = await response.text();
    const container = document.querySelector('.table-body');
    container.insertAdjacentHTML('beforeend', data);
    hideForm(rackAddForm, rackAddOverlay);
    lucide.createIcons();
  });

  linkProductForm.addEventListener('submit', async (e) => {
    e.preventDefault();

    const checkedProducts = document.querySelectorAll('.table-body input[type="checkbox"]:checked');
    const bookIds = Array.from(checkedProducts).map((checkbox) => checkbox.value);
    const rackName = linkProductForm.querySelector('.dropdown-select').value;
    const warehouse_id = document.querySelector('.warehouses-detail').dataset.id;
    const response = await fetch(config.rackApiUrl + '?action=link', {
      method: 'POST',
      body: JSON.stringify({ bookIds, rackName, warehouse_id }),
    });

    const data = await response.json();
    sessionStorage.setItem('warehouseId', getWarehouseId());
    expandRack(data.rackId);
    hideForm(linkProductForm, linkProductOverlay);
  });
}

function initRack() {
  const rackCards = document.querySelectorAll('.rack-card');
  rackCards.forEach((card) => {
    card.addEventListener('click', async (e) => {
      if (e.target.closest('.rack-expand')) {
        sessionStorage.setItem('warehouseId', getWarehouseId());
        expandRack(card.dataset.id);
      }

      if (e.target.closest('.rack-delete')) {
        if (confirm('Are you sure you want to delete this rack?')) {
          await fetch(config.rackApiUrl + '?action=delete&rackId=' + card.dataset.id);
          card.remove();
        }
      }
    });
  });
}

export function initRackDetailPage() {
  const backButton = document.querySelector('.back-btn');

  backButton.addEventListener('click', () => {
    expandWarehouse(sessionStorage.getItem('warehouseId'));
    sessionStorage.removeItem('warehouseId');
  });
}

export async function expandWarehouse(warehouseId) {
  const response = await fetch(config.warehousesApiUrl + warehouseId);
  const data = await response.text();
  contentArea.innerHTML = data;
  loadResources('warehouse-detail');
}

export async function expandRack(rackId) {
  const response = await fetch(
    config.rackDetailApiUrl + rackId + '&warehouseId=' + getWarehouseId(),
  );
  const data = await response.text();
  contentArea.innerHTML = data;
  loadResources('rack-detail');
}

function getWarehouseId() {
  return document.querySelector('.warehouses-detail').dataset.id;
}
