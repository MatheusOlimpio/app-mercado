import { Box, Button, Paper, Typography } from "@mui/material";
import React from "react";
import { DataGrid } from "@mui/x-data-grid";
import { Add } from "@mui/icons-material";
import ModalAddProduct from "../components/ManageProducts/ModalAddProduct";
import useGetProducts from "../hooks/useGetProducts";
import useGetTaxes from "../hooks/useGetTaxes";
import ModalAddTaxes from "../components/ManageTaxes/ModalAddTaxes";

const columns = [
  { field: "id", headerName: "ID", width: 90 },
  {
    field: "aliquota",
    headerName: "Percentual de imposto",
    width: 250,

    renderCell: (params) => {
      console.log(params);
      return `${params.value} %`;
    },
  },
  {
    field: "descricao",
    headerName: "Descricao",
    width: 150,
  },
];

export default function ManageTax() {
  const [openModal, setOpen] = React.useState(false);
  const { data, isLoading } = useGetTaxes();
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
          <ModalAddTaxes open={openModal} handleClose={handleCloseModal} />
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
