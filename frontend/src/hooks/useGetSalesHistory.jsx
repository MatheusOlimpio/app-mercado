import { useQuery } from "@tanstack/react-query";
import { fetchSales } from "../api/sales";

//react query hook for fetch product
const useGetSalesHistory = () => {
  return useQuery({
    queryKey: ["sales"],
    queryFn: fetchSales,
  });
};

export default useGetSalesHistory;
