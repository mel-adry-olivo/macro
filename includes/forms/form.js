import { fetchProducts } from '../../js/api.js';
import { showSnackbar } from '../../js/components/snackbar.js';

const selectInputs = document.querySelectorAll('.form-select-input');

selectInputs.forEach((input) => {
  input.addEventListener('focus', () => {
    input.parentElement.classList.add('selected');
  });

  input.addEventListener('blur', () => {
    input.parentElement.classList.remove('selected');
  });

  input.addEventListener('change', () => {
    input.parentElement.classList.remove('selected');
  });
});

document.addEventListener('click', (e) => {
  if (e.target.matches('.form-text-input[numbers][allow-comma]')) {
    showSnackbar('Tip', 'Put commas if multiple products', 2500);
  }

  if (e.target.matches('.remove-button')) {
    e.target.parentElement.remove();
  }

  if (e.target.matches('.form-search-results-item')) {
    const searchSelection = document.querySelector('.form-search-selection');
    const searchInput = document.querySelector('.form-text-input[search]');
    const searchResults = document.querySelector('.form-search-results');

    const selectedItem = e.target.textContent;

    const selectionItem = document.createElement('div');
    selectionItem.classList.add('form-search-selection-item');
    selectionItem.textContent = selectedItem;
    selectionItem.innerHTML = `${selectedItem} <button class="remove-button"><i data-lucide="x"></i></button>`;
    searchSelection.appendChild(selectionItem);
    searchInput.value = '';
    searchResults.innerHTML = '';
    searchResults.style.display = 'none';
    lucide.createIcons();
  }
});

document.addEventListener('input', async (e) => {
  if (e.target.matches('.form-text-input[numbers]')) {
    let cleanedValue;

    if (e.target.hasAttribute('allow-comma')) {
      cleanedValue = e.target.value.replace(/[^0-9.,]/g, '').replace(/^0+(?!$)/, '');
    } else {
      cleanedValue = e.target.value.replace(/[^0-9.]/g, '').replace(/^0+(?!$)/, '');
    }

    cleanedValue = cleanedValue.replace(/^-/, '').replace(/^0+(?!$)/, '');

    e.target.value = cleanedValue;
  }

  if (e.target.matches('.form-text-input[search]')) {
    const products = await fetchProducts();
    const searchTerm = e.target.value.trim().toLowerCase();
    const searchResults = e.target.nextElementSibling;

    const filteredProducts = products.filter((product) => product.name.toLowerCase().includes(searchTerm));

    searchResults.innerHTML = '';
    filteredProducts.forEach((item) => {
      const resultItem = document.createElement('div');
      resultItem.classList.add('form-search-results-item');
      resultItem.textContent = item.name;
      searchResults.appendChild(resultItem);
    });

    searchResults.style.display = searchTerm && filteredProducts.length > 0 ? 'block' : 'none';
  }
});
