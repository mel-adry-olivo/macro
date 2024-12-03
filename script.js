import { initNotifications } from './js/notifications.js';
import { initContentNavigation, selectContent } from './js/contentNav.js';
import { expandWarehouse } from './js/warehouse.js';

window.addEventListener('load', () => {
  // initContentNavigation();
  // const warehouseId = sessionStorage.getItem('warehouseId');
  // if (warehouseId) {
  //   expandWarehouse(warehouseId);
  //   window.history.replaceState(null, '', '.');
  //   setTimeout(() => {
  //     sessionStorage.removeItem('warehouseId');
  //   }, 3000);
  // }
});
