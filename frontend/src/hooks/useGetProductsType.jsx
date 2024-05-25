import { useQuery } from "@tanstack/react-query";
import { fetchTypeProducts } from "../api/type_products";

//react query hook for fetch product
const useGetProductsType = () => {
  return useQuery({
    queryKey: ["products", "types"],
    queryFn: fetchTypeProducts,
  });
};

export default useGetProductsType;
