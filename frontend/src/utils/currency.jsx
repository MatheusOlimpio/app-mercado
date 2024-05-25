export const formatCurrencyToNumber = (value) => {
  // Remove todos os pontos
  let formattedValue = value.replace(/\./g, "");
  // Troca a vírgula por ponto
  formattedValue = formattedValue.replace(/,/, ".");
  return formattedValue;
};
