import { Box, Button, Paper, Typography } from "@mui/material";
import React from "react";
import { DataGrid } from "@mui/x-data-grid";
import { Add } from "@mui/icons-material";
import ModalAddProduct from "../components/ManageProducts/ModalAddProduct";
import useGetProductsType from "../hooks/useGetProductsType";
import ModalAddProductType from "../components/ManageProductsType/ModalAddProductType";

const columns = [
  { field: "id", headerName: "ID", width: 90 },

  {
    field: "tipo",
    headerName: "Tipo",
    width: 150,
    editable: true,
  },
  {
    field: "aliquota",
    headerName: "Percentual de Imposto",
    type: "number",
    width: 200,
    editable: true,
    renderCell: (params) => {
      return `${params.value} %`;
    },
  },
];

export default function ManageProductsType() {
  const [openModal, setOpen] = React.useState(false);
  const { data, isLoading } = useGetProductsType();
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
          <Typography variant="h4">Gerenciar Categoria de Produtos</Typography>
          <Button
            onClick={handleOpenModal}
            startIcon={<Add />}
            variant="contained"
          >
            Categoria
          </Button>
          <ModalAddProductType
            open={openModal}
            handleClose={handleCloseModal}
          />
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
