import { TextField } from "@mui/material";
import { Controller } from "react-hook-form";

const IntegerInput = ({ control, name, label, errors, errorsMessage }) => {
  return (
    <Controller
      name={name}
      control={control}
      render={({ field: { onChange, value, ...field } }) => (
        <TextField
          {...field}
          label={label}
          variant="outlined"
          fullWidth
          value={value}
          error={errors?.[name] ? true : false}
          helperText={errors?.[name] ? errorsMessage : null}
          inputProps={{
            inputMode: "numeric",
            pattern: "[0-9]*",
          }}
          onChange={(e) => {
            const value = e.target.value;
            if (/^\d*$/.test(value)) {
              onChange(value);
            }
          }}
        />
      )}
    />
  );
};

export default IntegerInput;
