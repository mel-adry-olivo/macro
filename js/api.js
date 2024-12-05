export async function fetchProducts() {
  const response = await fetch('/macro/api/products.php');
  const data = await response.json();
  return data;
}
