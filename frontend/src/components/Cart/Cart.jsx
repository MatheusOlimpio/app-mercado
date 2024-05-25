import { Close } from "@mui/icons-material";
import {
  Badge,
  Box,
  IconButton,
  SwipeableDrawer,
  Typography,
} from "@mui/material";
import React from "react";
import { useCartStore } from "../../store/useCartStore";
import CartItem from "./CartItem";
import { styled } from "@mui/material/styles";
import ShoppingCartIcon from "@mui/icons-material/ShoppingCart";
import CartFooter from "./CartFooter";
import CartHeader from "./CartHeader";
import CartEmpty from "./CartEmpty";

const StyledBadge = styled(Badge)(({ theme }) => ({
  "& .MuiBadge-badge": {
    right: -3,
    top: 13,
    border: `2px solid ${theme.palette.background.paper}`,
    padding: "0 4px",
  },
}));

export default function Cart() {
  const [state, setState] = React.useState(false);
  const { cart, totalItems } = useCartStore();
  const toggleDrawer = (open) => (event) => {
    if (
      event &&
      event.type === "keydown" &&
      (event.key === "Tab" || event.key === "Shift")
    ) {
      return;
    }
    setState(open);
  };

  return (
    <>
      <IconButton color="inherit" onClick={toggleDrawer(true)}>
        <StyledBadge badgeContent={totalItems()} color="success">
          <ShoppingCartIcon />
        </StyledBadge>
      </IconButton>

      <SwipeableDrawer
        anchor={"right"}
        open={state}
        onClose={toggleDrawer(false)}
        onOpen={toggleDrawer(true)}
        PaperProps={{ sx: { width: "100%", maxWidth: 400 } }}
      >
        <Box sx={{ display: "flex", flexDirection: "column", height: "100%" }}>
          <CartHeader toggleDrawer={toggleDrawer} />
          <Box sx={{ overflowY: "auto", height: "100%" }}>
            {cart.length === 0 && <CartEmpty />}
            {cart.map((item) => (
              <CartItem
                key={item.id}
                id={item.id}
                nome={item.nome}
                quantidade={item.quantidade}
                valorTotal={item.valorTotal}
              />
            ))}
          </Box>
          <CartFooter />
        </Box>
      </SwipeableDrawer>
    </>
  );
}
