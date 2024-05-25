import { Delete } from "@mui/icons-material";
import { Box, Icon, IconButton } from "@mui/material";
import React from "react";
import { useCartStore } from "../../store/useCartStore";

export default function CartItem({ id, nome, quantidade, valorTotal }) {
  const { removeItem } = useCartStore();
  return (
    <Box
      sx={{
        display: "flex",
        justifyContent: "space-between",
        alignItems: "center",
        py: 4,
        px: 2,
        borderBottom: "1px solid #ccc",
      }}
    >
      <Box>
        <img
          width={50}
          src="https://cdn3.iconfinder.com/data/icons/online-states/150/Photos-512.png"
        />
      </Box>
      <Box
        sx={{
          display: "flex",
          flexDirection: "column",
          justifyContent: "flex-start",
        }}
      >
        <Box>{nome} </Box>
        <Box>Qtd: {quantidade}</Box>
      </Box>
      <Box>
        {parseFloat(valorTotal).toLocaleString("pt-BR", {
          style: "currency",
          currency: "BRL",
        })}
      </Box>
      <Box>
        <IconButton onClick={() => removeItem(id)}>
          <Delete />
        </IconButton>
      </Box>
    </Box>
  );
}
