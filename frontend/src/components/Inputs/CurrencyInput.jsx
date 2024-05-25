import React from "react";
import { Controller } from "react-hook-form";
import { TextField } from "@mui/material";
import MaskedInput from "react-text-mask";
import createNumberMask from "text-mask-addons/dist/createNumberMask";

// Configuração da máscara para moeda brasileira
const currencyMask = createNumberMask({
  prefix: "",
  suffix: "",
  includeThousandsSeparator: true,
  thousandsSeparatorSymbol: ".",
  allowDecimal: true,
  decimalSymbol: ",",
  decimalLimit: 2,
  integerLimit: null,
  allowNegative: false,
  allowLeadingZeroes: false,
});

const CurrencyInput = ({
  control,
  name,
  label,
  defaultValue,
  errors,
  errorsMessage,
}) => {
  return (
    <Controller
      name={name}
      control={control}
      defaultValue={defaultValue || ""}
      render={({ field }) => (
        <MaskedInput
          {...field}
          mask={currencyMask}
          render={(ref, props) => (
            <TextField
              {...props}
              inputRef={ref}
              label={label}
              variant="outlined"
              fullWidth
              error={Boolean(errors)}
              helperText={errorsMessage}
            />
          )}
        />
      )}
    />
  );
};
export default CurrencyInput;
