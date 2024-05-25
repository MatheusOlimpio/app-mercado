import api from "../utils/api";

export async function fetchSales() {
  const { data } = await api.get("/cart");
  return data;
}
