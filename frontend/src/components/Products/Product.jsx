import * as React from "react";
import Card from "@mui/material/Card";
import CardActions from "@mui/material/CardActions";
import CardContent from "@mui/material/CardContent";
import CardMedia from "@mui/material/CardMedia";
import Button from "@mui/material/Button";
import Typography from "@mui/material/Typography";
import AddShoppingCartIcon from "@mui/icons-material/AddShoppingCart";
import ImageNotSupportedIcon from "@mui/icons-material/ImageNotSupported";
import { Box } from "@mui/material";
import { useCartStore } from "../../store/useCartStore";

export default function Product({ product }) {
  const { addItem } = useCartStore();
  return (
    <Card sx={{ width: 400, p: 2 }}>
      <CardMedia
        sx={{ height: 140, backgroundSize: "contain" }}
        image="https://cdn3.iconfinder.com/data/icons/online-states/150/Photos-512.png"
        title="green iguana"
      />
      <CardContent
        sx={{
          display: "flex",
          flexDirection: "column",
          justifyContent: "center",
          alignItems: "center",
          gap: 5,
        }}
      >
        <Typography gutterBottom variant="h5" component="div">
          {product.nome}
        </Typography>
        <Typography variant="h4" gutterBottom>
          {parseFloat(product.valor).toLocaleString("pt-BR", {
            style: "currency",
            currency: "BRL",
          })}
        </Typography>
      </CardContent>
      <CardActions
        sx={{
          display: "flex",
          flexDirection: "column",
          justifyContent: "center",
          alignItems: "center",
          width: "100%",
        }}
      >
        <Button onClick={() => addItem(product)} variant="text" size="small">
          <AddShoppingCartIcon /> Adicionar ao carrinho
        </Button>
      </CardActions>
    </Card>
  );
}
