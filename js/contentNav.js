import config from '../config.js';
import { initProductsPage } from './products.js';
import { initWarehousesPage, initWarehouseDetailPage } from './warehouse.js';

const navItems = document.querySelectorAll('.nav-item');
export const contentArea = document.querySelector('.content');

export function initContentNavigation() {
  const defaultNavItem = Array.from(navItems).find(
    (item) => item.dataset.content == config.defaultContent,
  );

  if (defaultNavItem) {
    selectNavItem(defaultNavItem);
    selectContent(defaultNavItem.dataset.content);
  }

  navItems.forEach((item) => {
    item.addEventListener('click', async (event) => {
      event.preventDefault();
      selectNavItem(event.currentTarget);
      await selectContent(event.target.dataset.content);
    });
  });
}

export async function selectContent(content) {
  const response = await fetch(config.contentApiUrl + content);
  const data = await response.text();
  contentArea.innerHTML = data;
  loadResources(content);
}

export function selectNavItem(item) {
  navItems.forEach((it) => it.classList.remove('active'));
  item.classList.add('active');
}

export function loadResources($content) {
  lucide.createIcons();
  switch ($content) {
    case 'products':
      initProductsPage();
      break;
    case 'warehouses':
      initWarehousesPage();
      break;
    case 'warehouse-detail':
      initWarehouseDetailPage();
      break;
  }
}
