import { navigateTo } from './router.js';

const config = {
  contentApiUrl: '/macro/pages/',
  warehousesApiUrl: '/macro/api/warehouses.php?wid=',
  rackApiUrl: '/macro/api/rack.php',
  rackDetailApiUrl: '/macro/api/rack-detail.php?rackId=',
  linkedProductApiUrl: '/macro/api/linked-products.php?value=',
};

document.querySelector('.container').addEventListener('click', (e) => {
  if (e.target.matches('.nav-item')) {
    document.querySelector('.nav-item.active').classList.remove('active');
    e.target.classList.add('active');
  }

  if (e.target.matches('.link-product-btn')) {
    const form = document.querySelector('.link-product-form');
    const overlay = document.querySelector('.link-product-overlay');
    showForm(form, overlay);
  }

  if (e.target.matches('.btn-cancel.link')) {
    const form = document.querySelector('.link-product-form');
    const overlay = document.querySelector('.link-product-overlay');
    hideForm(form, overlay);
  }

  if (e.target.matches('.create-rack-btn')) {
    const form = document.querySelector('.warehouse-add-rack-form');
    const overlay = document.querySelector('.add-rack-overlay');
    showForm(form, overlay);
  }

  if (e.target.matches('.btn-cancel.rack')) {
    const form = document.querySelector('.warehouse-add-rack-form');
    const overlay = document.querySelector('.add-rack-overlay');
    hideForm(form, overlay);
  }

  if (e.target.matches('.rack-delete')) {
    if (confirm('Are you sure you want to delete this rack?')) {
      const rackId = e.target.closest('.rack-card').dataset.id;
      fetch(config.rackApiUrl + '?action=delete&rackId=' + rackId, { method: 'POST' });
      e.target.closest('.rack-card').remove();
    }
  }
});

document.querySelector('.container').addEventListener('change', async (e) => {
  if (e.target.matches('.link-product-form .dropdown-select')) {
    const selectedValue = e.target.value;
    const warehouseId = document.querySelector('.warehouses-detail').dataset.id;
    const response = await fetch(
      config.linkedProductApiUrl + selectedValue + '&warehouse_id=' + warehouseId,
    );
    const data = await response.text();
    const container = e.target.closest('.link-product-form').querySelector('.table-body');
    container.innerHTML = data;
  }
});

document.querySelector('.container').addEventListener('change', async (e) => {
  const formContainer = e.target.closest('.link-product-form');
  if (!formContainer) return;

  const tableBody = formContainer.querySelector('.table-body');
  const selectAllCheckbox = formContainer.querySelector('.select-all-checkbox');

  if (e.target.matches('.select-all-checkbox')) {
    const isChecked = e.target.checked;
    tableBody.querySelectorAll('input[type="checkbox"]').forEach((checkbox) => {
      checkbox.checked = isChecked;
    });
  }

  if (e.target.matches('.table-body input[type="checkbox"]')) {
    const rowCheckboxes = Array.from(tableBody.querySelectorAll('input[type="checkbox"]'));
    const allChecked = rowCheckboxes.every((checkbox) => checkbox.checked);
    selectAllCheckbox.checked = allChecked;
  }
});

document.querySelector('.container').addEventListener('submit', async (e) => {
  e.preventDefault();

  if (e.target.matches('.link-product-form')) {
    const checkedProducts = document.querySelectorAll('.table-body input[type="checkbox"]:checked');
    const bookIds = Array.from(checkedProducts).map((checkbox) => checkbox.value);
    const rackName = e.target.querySelector('.dropdown-select').value;
    const warehouse_id = document.querySelector('.warehouses-detail').dataset.id;
    const overlay = document.querySelector('.link-product-overlay');

    const response = await fetch(config.rackApiUrl + '?action=link', {
      method: 'POST',
      body: JSON.stringify({ bookIds, rackName, warehouse_id }),
    });

    const data = await response.json();
    navigateTo('/macro/warehouses/' + warehouse_id + '/' + data.rackId);
    hideForm(e.target, overlay);
  }

  if (e.target.matches('.warehouse-add-rack-form')) {
    const overlay = document.querySelector('.add-rack-overlay');
    const formData = new FormData(e.target);
    const response = await fetch(config.rackApiUrl + '?action=create', {
      method: 'POST',
      body: JSON.stringify(Object.fromEntries(formData)),
    });
    const data = await response.text();
    const container = document.querySelector('.table-body');
    container.insertAdjacentHTML('beforeend', data);
    hideForm(e.target, overlay);
    lucide.createIcons();
  }
});

function toggleVisibility(element, show = true) {
  element.classList.toggle('show', show);
}
function showForm(form, overlay) {
  toggleVisibility(form);
  toggleVisibility(overlay);
  overlay.addEventListener('click', (e) => {
    if (e.target === overlay && form.classList.contains('show')) {
      hideForm(form, overlay);
    }
  });
}
function hideForm(form, overlay) {
  form.reset();

  const imageContainer = form.querySelector('.image-container');
  let imgElement = undefined;

  if (imageContainer) {
    imgElement = imageContainer.querySelector('img');
  }

  if (imgElement) {
    imgElement.remove();
    imageContainer.style.display = 'none';
  }

  toggleVisibility(form, false);
  toggleVisibility(overlay, false);
}