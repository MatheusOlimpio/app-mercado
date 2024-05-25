import { FormControl, InputLabel, MenuItem, Select } from "@mui/material";
import React, { useEffect, useState } from "react";
import { Controller } from "react-hook-form";
import api from "../../utils/api";

export default function ProductType({
  control,
  name,
  defaultValue,
  errors,
  errorsMessage,
}) {
  const [products, setProducts] = useState([]);

  useEffect(() => {
    api
      .get("/type-products")
      .then((response) => {
        setProducts(response.data);
      })
      .catch((error) => {
        console.error("There was an error fetching the products!", error);
      });
  }, []);

  return (
    <Controller
      render={({ field }) => (
        <FormControl fullWidth>
          <InputLabel id="demo-simple-select-label">Tipo do produto</InputLabel>
          <Select
            {...field}
            labelId="demo-simple-select-label"
            id="demo-simple-select"
            label="Tipo do Produto"
            error={errors}
            helperText={errorsMessage}
          >
            {products.map(({ id, tipo }) => (
              <MenuItem key={id} value={id}>
                {tipo}
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
