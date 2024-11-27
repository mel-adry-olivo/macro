import config from './config.js';

const navItems = document.querySelectorAll('.nav-item');
const contentArea = document.querySelector('.content');

window.onload = () => {
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
      selectContent(event.target.dataset.content);
    });
  });
};

async function selectContent(content) {
  const response = await fetch(config.contentApiUrl + content);
  const data = await response.text();
  contentArea.innerHTML = data;
  lucide.createIcons();
}

function selectNavItem(item) {
  navItems.forEach((it) => it.classList.remove('active'));
  item.classList.add('active');
}
