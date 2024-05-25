import React from "react";
import Product from "./Product";
import { Box } from "@mui/material";
import useGetProducts from "../../hooks/useGetProducts";

export default function Products() {
  const { data, error, isLoading } = useGetProducts();

  if (isLoading) {
    return <p>Loading...</p>;
  }

  if (!data || data.length === 0) {
    return (
      <Box
        sx={{
          display: "flex",
          justifyContent: "center",
          alignItems: "center",
          height: "70vh",
        }}
      >
        Não há produtos cadastrados{" "}
      </Box>
    );
  }

  return (
    <Box sx={{ display: "flex", flexWrap: "wrap", gap: 10 }}>
      {data?.map((product) => (
        <Product key={product.id} product={product} />
      ))}
    </Box>
  );
}
