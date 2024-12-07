export function toggleVisibility(element, show = true) {
  element.classList.toggle('show', show);
}

export async function showOverlay() {
  const overlay = document.querySelector('.page-overlay');
  overlay.addEventListener('click', (e) => {
    if (e.target === overlay && overlay.classList.contains('show')) {
      hideOverlay();
    }
  });
  toggleVisibility(overlay);
}

export async function hideOverlay() {
  const overlay = document.querySelector('.page-overlay');
  toggleVisibility(overlay, false);
}

export async function showForm(form) {
  const overlay = document.querySelector('.page-overlay');

  const response = await fetch('/macro/includes/forms/' + form + '.php');
  const data = await response.text();
  overlay.innerHTML = data;
  const script = document.createElement('script');
  script.src = '/macro/includes/forms/form.js';
  script.type = 'module';
  overlay.appendChild(script);
  lucide.createIcons();
  showOverlay();
}
