import api from "../utils/api";

export async function fetchTaxes() {
  const { data } = await api.get("/taxes");
  return data;
}

export async function fetchTaxesById() {
  const { data } = await api.get("/taxes");
  return data;
}
