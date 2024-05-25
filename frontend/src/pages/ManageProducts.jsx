import { Box, Button, Paper, Typography } from "@mui/material";
import React from "react";
import { DataGrid } from "@mui/x-data-grid";
import { Add } from "@mui/icons-material";
import ModalAddProduct from "../components/ManageProducts/ModalAddProduct";
import useGetProducts from "../hooks/useGetProducts";

const columns = [
  { field: "id", headerName: "ID", width: 90 },
  {
    field: "nome",
    headerName: "Produto",
    width: 150,
    editable: true,
  },
  {
    field: "tipo",
    headerName: "Tipo",
    width: 150,
    editable: true,
  },
  {
    field: "valor",
    headerName: "Valor",
    type: "number",
    width: 110,
    editable: true,
    renderCell: (params) => {
      console.log(params);
      return parseFloat(params.value).toLocaleString("pt-BR", {
        style: "currency",
        currency: "BRL",
      });
    },
  },
];

export default function ManageProducts() {
  const [openModal, setOpen] = React.useState(false);
  const { data, isLoading } = useGetProducts();
  const handleCloseModal = () => {
    setOpen(false);
  };

  const handleOpenModal = () => {
    setOpen(true);
  };

  return (
    <Box
      sx={{
        width: "100%",
      }}
    >
      <Paper sx={{ width: "100%" }}>
        <Box
          sx={{
            display: "flex",
            alignItems: "center",
            justifyContent: "space-between",

            p: 2,
          }}
        >
          <Typography variant="h4">Gerenciar Produtos</Typography>
          <Button
            onClick={handleOpenModal}
            startIcon={<Add />}
            variant="contained"
          >
            Produto
          </Button>
          <ModalAddProduct open={openModal} handleClose={handleCloseModal} />
        </Box>
        <Box sx={{ height: "70vh", width: "100%" }}>
          <DataGrid
            rows={data || []}
            columns={columns}
            initialState={{
              pagination: {
                paginationModel: {
                  pageSize: 10,
                },
              },
            }}
          />
        </Box>
      </Paper>
    </Box>
  );
}
