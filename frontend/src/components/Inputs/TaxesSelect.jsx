import { FormControl, InputLabel, MenuItem, Select } from "@mui/material";
import React, { useEffect, useState } from "react";
import { Controller } from "react-hook-form";
import api from "../../utils/api";

export default function TaxesSelect({
  control,
  name,
  defaultValue,
  errors,
  errorsMessage,
}) {
  const [taxes, setTaxes] = useState([]);

  useEffect(() => {
    api
      .get("/taxes")
      .then((response) => {
        setTaxes(response.data);
      })
      .catch((error) => {
        console.error("There was an error fetching the products!", error);
      });
  }, []);

  return (
    <Controller
      render={({ field }) => (
        <FormControl fullWidth>
          <InputLabel id="demo-simple-select-label">
            Percentual de imposto
          </InputLabel>
          <Select
            {...field}
            labelId="demo-simple-select-label"
            id="demo-simple-select"
            label="Percentual de imposto"
            error={errors}
            helperText={errorsMessage}
          >
            {taxes.map(({ id, aliquota, descricao }) => (
              <MenuItem key={id} value={id}>
                {aliquota}% - {descricao}
              </MenuItem>
            ))}
          </Select>
        </FormControl>
      )}
      control={control}
      name={name}
      defaultValue={defaultValue}
    />
  );
}
