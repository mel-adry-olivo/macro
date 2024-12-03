import { initProductsPage } from './products.js';
import { initWarehousesPage, initRackDetailPage, initWarehouseDetailPage } from './warehouse.js';

const config = {
  defaultContent: 'dashboard',
  contentApiUrl: '/macro/pages/',
  warehousesApiUrl: './api/warehouses.php?wid=',
  rackApiUrl: './api/rack.php',
  rackDetailApiUrl: './api/rack-detail.php?rackId=',
  linkedProductApiUrl: './api/linked-products.php?value=',
};

const routes = {
  '/macro/dashboard': () => renderDashboard(),
  '/macro/orders': () => renderOrders(),
  '/macro/products': () => renderProducts(),
  '/macro/warehouses': () => renderWarehouses(),
  '/macro/warehouses/:id': (id) => renderWarehouse(id),
  '/macro/warehouses/:id/:rack': (id, rack) => renderRack(id, rack),
};

function initRouter() {
  window.addEventListener('popstate', handleRoute);
  handleRoute();
}

// Handle routing based on URL
function handleRoute() {
  const currentPath = window.location.pathname;

  for (let route in routes) {
    const regex = new RegExp('^' + route.replace(/:[^\s/]+/g, '([\\w-]+)') + '$');
    const match = currentPath.match(regex);

    if (match) {
      const params = match.slice(1);
      routes[route](...params);
      return;
    }
  }

  renderNotFound();
}

function renderDashboard() {
  selectContent('dashboard');
}
function renderOrders() {
  selectContent('orders');
}

function renderProducts() {
  selectContent('products');
}

function renderWarehouses() {
  selectContent('warehouses');
}

function renderWarehouse(id) {
  selectContent('warehouse-detail', { id });
}

function renderRack(id, rack) {
  selectContent('rack-detail', { id, rack });
}

function renderNotFound() {
  document.querySelector('.content').innerHTML = '<h1>Page Not Found</h1>';
}

export function navigateTo(path) {
  window.history.pushState({}, '', path);
  handleRoute();
}

async function selectContent(content, params = {}) {
  const paramsString = Object.keys(params)
    .map((key) => `${key}=${params[key]}`)
    .join('&');

  const url = `${config.contentApiUrl}${content}.php?${paramsString}`;
  console.log(url);

  const response = await fetch(url);
  const data = await response.text();
  document.querySelector('.content').innerHTML = data;
  loadResources(content);
}

function loadResources($content) {
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
    case 'rack-detail':
      initRackDetailPage();
      break;
  }
}

document
  .querySelector('.nav-item[data-content="dashboard"]')
  .addEventListener('click', () => navigateTo('/macro/dashboard'));
document
  .querySelector('.nav-item[data-content="orders"]')
  .addEventListener('click', () => navigateTo('/macro/orders'));
document
  .querySelector('.nav-item[data-content="products"]')
  .addEventListener('click', () => navigateTo('/macro/products'));
document
  .querySelector('.nav-item[data-content="warehouses"]')
  .addEventListener('click', () => navigateTo('/macro/warehouses'));
document
  .querySelector('.nav-item[data-content="suppliers"]')
  .addEventListener('click', () => navigateTo('/macro/settings'));

document.querySelector('.nav-item[data-content="dashboard"]').click();

initRouter();
