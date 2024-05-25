import { useQuery } from "@tanstack/react-query";
import { fetchProducts } from "../api/products";

//react query hook for fetch product
const useGetProducts = () => {
  return useQuery({
    queryKey: ["products"],
    queryFn: fetchProducts,
  });
};

export default useGetProducts;
