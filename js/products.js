import { hideForm, showForm } from './utils.js';

function initProductsPage() {
  const addOverlay = document.querySelector('.add-overlay');
  const addProductButton = document.querySelector('.add-product-btn');
  const addProductForm = document.querySelector('.product__add-form');
  const addProductFormCancel = document.querySelector('.btn-cancel');
  const imageContainer = document.querySelector('.image-container');
  const imageChooser = document.querySelector('.image-chooser');

  addProductButton.addEventListener('click', () => {
    showForm(addProductForm, addOverlay);
  });

  addProductFormCancel.addEventListener('click', () => {
    hideForm(addProductForm, addOverlay);
  });

  imageChooser.addEventListener('change', () => {
    const file = imageChooser.files[0];
    const reader = new FileReader();
    reader.onload = () => {
      const image = new Image();
      image.src = reader.result;
      imageContainer.innerHTML = '';
      imageContainer.appendChild(image);
      imageContainer.style.display = 'block';
    };
    reader.readAsDataURL(file);
  });
}

export default initProductsPage;
