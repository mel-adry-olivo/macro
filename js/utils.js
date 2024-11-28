export function toggleVisibility(element, show = true) {
  element.classList.toggle('show', show);
}

export function showForm(form, overlay) {
  toggleVisibility(form);
  toggleVisibility(overlay);
  overlay.addEventListener('click', (e) => {
    if (e.target === overlay && form.classList.contains('show')) {
      hideForm(form, overlay);
    }
  });
}

export function hideForm(form, overlay) {
  form.reset();

  const imageContainer = form.querySelector('.image-container');
  const imgElement = imageContainer.querySelector('img');

  if (imgElement) {
    imgElement.remove();
    imageContainer.style.display = 'none';
  }

  toggleVisibility(form, false);
  toggleVisibility(overlay, false);
}
