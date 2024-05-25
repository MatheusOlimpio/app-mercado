import { Box, Button, Paper, Typography } from "@mui/material";
import React from "react";
import { DataGrid } from "@mui/x-data-grid";
import useGetSalesHistory from "../hooks/useGetSalesHistory";
import { dateTimeFormat } from "../utils/datetime";

const columns = [
  { field: "id", headerName: "ID", width: 90 },

  {
    field: "qtd_itens",
    headerName: "Total de Items",
    width: 150,
  },
  {
    field: "valor_total",
    headerName: "Valor Total R$",
    type: "number",
    width: 200,

    renderCell: (params) => {
      return parseFloat(params.value).toLocaleString("pt-BR", {
        style: "currency",
        currency: "BRL",
      });
    },
  },
  {
    field: "data_criacao",
    headerName: "Data Venda",
    width: 200,
    renderCell: (params) => {
      return dateTimeFormat(params.value);
    },
  },
];

export default function SalesHistory() {
  const { data, isLoading } = useGetSalesHistory();

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
          <Typography variant="h4">Histórico de Vendas</Typography>
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
