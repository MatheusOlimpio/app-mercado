import React from "react";
import Box from "@mui/material/Box";
import Button from "@mui/material/Button";
import Typography from "@mui/material/Typography";
import Modal from "@mui/material/Modal";
import { TextField } from "@mui/material";
import { Controller, useForm } from "react-hook-form";
import CurrencyInput from "../Inputs/CurrencyInput";
import ProductType from "../Inputs/ProductType";
import { useMutation, useQueryClient } from "@tanstack/react-query";

const style = {
  position: "absolute",
  top: "50%",
  left: "50%",
  transform: "translate(-50%, -50%)",
  display: "flex",
  flexDirection: "column",
  gap: 5,
  width: 400,
  bgcolor: "background.paper",
  border: "2px solid #ccc",
  borderRadius: 2,
  boxShadow: 24,
  p: 4,
};

import * as Yup from "yup";
import { yupResolver } from "@hookform/resolvers/yup";
import api from "../../utils/api";
import toast from "react-hot-toast";
import { LoadingButton } from "@mui/lab";
import { formatCurrencyToNumber } from "../../utils/currency";

const validationSchema = Yup.object().shape({
  nome: Yup.string()
    .required("Nome do produto é obrigatório")
    .min(3, "Nome do produto deve ter pelo menos 3 caracteres")
    .max(50, "Nome do produto não pode exceder 50 caracteres"),
  tipo_produto: Yup.string()
    .required("ID do produto é obrigatório")
    .matches(
      /^[a-zA-Z0-9_-]+$/,
      "ID do produto deve conter apenas letras, números, underscores ou hifens"
    ),
  valor: Yup.string().required("Preço é obrigatório"),
});

export default function ModalAddProduct({ open, handleClose }) {
  const {
    handleSubmit,
    formState: { errors },
    control,
  } = useForm({
    resolver: yupResolver(validationSchema),
  });
  const queryClient = useQueryClient();
  const onSubmit = (data) => {
    data.valor = formatCurrencyToNumber(data.valor);
    mutation.mutate(data);
  };

  const mutation = useMutation({
    mutationFn: (data) => {
      return api.post("/products", data);
    },
    onSuccess: () => {
      handleClose();
      toast.success("Produto Cadastrado com sucesso.");
      queryClient.invalidateQueries({ queryKey: ["products"] });
    },
    onError: (error) => {
      toast.error("Ocorreu um erro ao cadastrar o produto");
    },
  });

  return (
    <Modal
      open={open}
      onClose={handleClose}
      aria-labelledby="modal-modal-title"
      aria-describedby="modal-modal-description"
    >
      <Box sx={style}>
        <Typography variant="h5">Cadastro de produto</Typography>
        <Controller
          render={({ field }) => (
            <TextField
              {...field}
              label="Nome do produto"
              variant="outlined"
              errors={Object.keys(errors).length > 0 ? errors : null}
              helperText={errors?.nome?.message}
            />
          )}
          control={control}
          name="nome"
        />
        <ProductType
          control={control}
          name="tipo_produto"
          defaultValue={""}
          errors={Object.keys(errors).length > 0 ? errors : null}
          errorsMessage={errors?.type?.message}
        />
        <CurrencyInput
          control={control}
          name={"valor"}
          errors={Object.keys(errors).length > 0 ? errors : null}
          errorsMessage={errors?.price?.message}
        />

        <Box sx={{ display: "flex", gap: 2, justifyContent: "flex-end" }}>
          <Button disabled={mutation.isLoading} onClick={handleClose}>
            Cancelar
          </Button>
          <LoadingButton
            loading={mutation.isLoading}
            variant="contained"
            onClick={handleSubmit(onSubmit)}
          >
            Salvar
          </LoadingButton>
        </Box>
      </Box>
    </Modal>
  );
}
