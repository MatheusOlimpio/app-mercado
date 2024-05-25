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
import IntegerInput from "../Inputs/IntegerInput";

const validationSchema = Yup.object().shape({
  descricao: Yup.string()
    .required("O tipo de produto é obrigatório")
    .min(3, "O tipo do produto deve ter pelo menos 3 caracteres")
    .max(50, "O tipo do produto não pode exceder 50 caracteres"),
  aliquota: Yup.number("Insira um valor numérico").required(
    "O imposto é obrigatório"
  ),
});

export default function ModalAddTaxes({ open, handleClose }) {
  const {
    handleSubmit,
    formState: { errors },
    control,
  } = useForm({
    resolver: yupResolver(validationSchema),
  });
  const queryClient = useQueryClient();
  const onSubmit = (data) => {
    mutation.mutate(data);
  };

  const mutation = useMutation({
    mutationFn: (data) => {
      return api.post("/taxes", data);
    },
    onSuccess: () => {
      handleClose();
      toast.success("Imposto cadastrado com sucesso.");
      queryClient.invalidateQueries({ queryKey: ["products"] });
    },
    onError: (error) => {
      toast.error("Ocorreu um erro ao cadastrar o imposto");
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
        <Typography variant="h5">Cadastro de Impostos</Typography>
        <Controller
          render={({ field }) => (
            <TextField
              {...field}
              label="Descricao"
              variant="outlined"
              errors={Boolean(errors?.descricao)}
              helperText={errors?.descricao?.message}
            />
          )}
          control={control}
          name="descricao"
        />
        <IntegerInput
          control={control}
          name="aliquota"
          label="Aliquota"
          errors={errors}
          errorsMessage={errors?.aliquota?.message}
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
