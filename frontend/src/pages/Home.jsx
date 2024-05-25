import { Box } from "@mui/material";
import React from "react";
import Products from "../components/Products/Products";

export default function Home() {
  return (
    <Box>
      <Box
        m={10}
        sx={{ display: "flex", justifyContent: "center", alignItems: "center" }}
      >
        <Products />
      </Box>
    </Box>
  );
}
