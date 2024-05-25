import api from "../utils/api";

export async function fetchProducts() {
  const { data } = await api.get("/products");
  return data;
}

export async function fetchProductsById() {
  const { data } = await api.get("/products");
  return data;
}
