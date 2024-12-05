export const productsState = {};

export function setProductsState(state) {
  productsState = state;
}

export function getProductsState() {
  return productsState;
}

export function clearProductsState() {
  productsState = {};
}
