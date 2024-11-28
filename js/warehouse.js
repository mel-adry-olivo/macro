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
}

export function initWarehouseDetailPage() {
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
}

export async function expandWarehouse(warehouseId) {
  const response = await fetch(config.warehousesApiUrl + warehouseId);
  const data = await response.text();
  contentArea.innerHTML = data;
  loadResources('warehouse-detail');
}
