import { Box, Typography } from "@mui/material";
import React from "react";

export default function CartEmpty() {
  return (
    <Box
      sx={{
        display: "flex",
        justifyContent: "center",
        alignItems: "center",
        height: "100vh",
      }}
    >
      <Typography>Carrinho Vazio</Typography>
    </Box>
  );
}
