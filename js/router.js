import { config } from './config.js';

function initRouter() {
  window.addEventListener('popstate', handleRoute);
  handleRoute();
}

const routes = {
  '/macro/:page': (page) => loadPageContent(page),
  '/macro/warehouses/:id': (id) => loadPageContent('warehouse-detail', { id }),
};

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
}

async function loadPageContent(content, params = {}) {
  const paramsString = Object.keys(params)
    .map((key) => `${key}=${params[key]}`)
    .join('&');

  const url = `${config.contentApiUrl}${content}.php?${paramsString}`;
  try {
    const response = await fetch(url);
    if (!response.ok) throw new Error('Failed to load content');

    const data = await response.text();
    document.querySelector('.content').innerHTML = '';
    document.querySelector('.content').innerHTML = data;

    lucide.createIcons();
  } catch (error) {
    console.log(error);
    document.querySelector('.content').innerHTML = '<div class="error">An error occurred. Please try again later.</div>';
  }
}

export function navigateTo(path) {
  window.history.pushState({}, '', path);
  handleRoute();
}

document.querySelector('.container').addEventListener('click', (e) => {
  if (e.target.matches('.nav-item')) {
    switch (e.target.dataset.content) {
      case 'inbound':
        navigateTo('/macro/inbound');
        break;
      case 'outbound':
        navigateTo('/macro/outbound');
        break;
      case 'products':
        navigateTo('/macro/products');
        break;
      case 'warehouses':
        navigateTo('/macro/warehouses');
        break;
    }
  }

  if (e.target.matches('.warehouse-expand[aria-label="view"]')) {
    const warehouseId = e.target.closest('.warehouse-card').dataset.id;
    navigateTo(`/macro/warehouses/${warehouseId}`);
  }
});

const defaultNav = document.querySelector('.nav-item[data-content="inbound"]');
if (defaultNav) {
  defaultNav.click();
}

initRouter();
