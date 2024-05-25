import { useQuery } from "@tanstack/react-query";
import { fetchTaxes } from "../api/taxes";

//react query hook for fetch product
const useGetTaxes = () => {
  return useQuery({
    queryKey: ["products", "taxes"],
    queryFn: fetchTaxes,
  });
};

export default useGetTaxes;
