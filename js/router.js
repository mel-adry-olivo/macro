const route = (e) => {
  e.preventDefault();
  handleRoute(e.target.href);
};

const handleRoute = async (route) => {
  const html = await fetch(route).then((data) => data.text());
  document.querySelector('.content').innerHTML = html;
  lucide.createIcons();
  document.querySelectorAll('a').forEach((link) => link.addEventListener('click', route));
};

document.querySelectorAll('a').forEach((link) => link.addEventListener('click', route));
window.onload = () => handleRoute(window.location.href);
