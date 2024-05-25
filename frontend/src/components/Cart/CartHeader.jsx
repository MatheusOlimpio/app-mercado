import { Close } from "@mui/icons-material";
import { Box, IconButton, Typography } from "@mui/material";
import React from "react";

export default function CartHeader({ toggleDrawer }) {
  return (
    <Box
      sx={{
        p: 2,
        display: "flex",
        justifyContent: "center",
        alignItems: "center",
      }}
    >
      <Box sx={{ position: "absolute", top: 12, left: 20 }}>
        <IconButton onClick={toggleDrawer(false)}>
          <Close />
        </IconButton>
      </Box>
      <Box
        sx={{
          display: "flex",
          alignItems: "center",
          justifyContent: "center",
        }}
      >
        <Typography variant="h6">Carrinho</Typography>
      </Box>
    </Box>
  );
}
