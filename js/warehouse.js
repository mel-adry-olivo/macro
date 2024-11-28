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

  createRackButton.addEventListener('click', () => {
    showForm(rackAddForm, rackAddOverlay);
  });

  rackAddCancel.addEventListener('click', () => {
    hideForm(rackAddForm, rackAddOverlay);
  });

  backButton.addEventListener('click', () => {
    selectContent('warehouses');
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
}

function initRack() {
  const rackCards = document.querySelectorAll('.rack-card');
  rackCards.forEach((card) => {
    card.addEventListener('click', async (e) => {
      if (e.target.closest('.rack-expand')) {
        const warehouse_id = document.querySelector('.warehouses-detail').dataset.id;
        sessionStorage.setItem('warehouseId', warehouse_id);
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
  const response = await fetch(config.rackDetailApiUrl + rackId);
  const data = await response.text();
  contentArea.innerHTML = data;
  loadResources('rack-detail');
}
