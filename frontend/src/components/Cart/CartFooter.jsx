import { Box, Button } from "@mui/material";
import React from "react";
import { useCartStore } from "../../store/useCartStore";
import { useMutation } from "@tanstack/react-query";
import api from "../../utils/api";
import toast from "react-hot-toast";
import { LoadingButton } from "@mui/lab";

export default function CartFooter() {
  const { cart, totalPrice, totalItems, removeAllItems } = useCartStore();
  console.log(cart);
  const finalizarCarrinho = useMutation({
    mutationFn: () =>
      api.post("/cart", {
        items: cart,
        total_items: totalItems(),
        total_preco: totalPrice(),
      }),

    onSuccess: () => {
      removeAllItems();
      toast.success("Carrinho finalizado");
    },

    onError: () => {
      toast.error("Erro ao finalizar o carrinho");
    },
  });

  return (
    <Box
      sx={{
        boxShadow: "0 0 10px 0 rgba(0, 0, 0, 0.2)",
        borderTop: "1px solid #ccc",
        p: 3,
        backgroundColor: "white",
      }}
    >
      <Box
        sx={{
          display: "flex",
          flexDirection: "column",
          alignItems: "flex-end",
          gap: 3,
        }}
      >
        <Box>Total de itens: {totalItems()}</Box>
        <Box>
          Tota:{" "}
          {totalPrice().toLocaleString("pt-BR", {
            style: "currency",
            currency: "BRL",
          })}
        </Box>
      </Box>
      <LoadingButton
        onClick={() => finalizarCarrinho.mutate()}
        loading={finalizarCarrinho.isLoading}
        sx={{ width: `100%`, mt: 3 }}
        disabled={totalItems() === 0}
        variant="contained"
      >
        Finalizar Compra
      </LoadingButton>
    </Box>
  );
}
