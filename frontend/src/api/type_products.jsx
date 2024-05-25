import api from "../utils/api";

export async function fetchTypeProducts() {
  const { data } = await api.get("/type-products");
  return data;
}

export async function fetchTypeProductsById() {
  const { data } = await api.get("/type-products");
  return data;
}
