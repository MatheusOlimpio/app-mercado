export function dateTimeFormat(dateTime) {
  // Remove a fração de segundos
  const cleanDate = dateTime.split(".")[0];

  // Cria um objeto Date
  const date = new Date(cleanDate + "Z"); // Adiciona 'Z' para indicar UTC

  // Formata a data manualmente
  const day = String(date.getUTCDate()).padStart(2, "0");
  const month = String(date.getUTCMonth() + 1).padStart(2, "0"); // Mês começa do 0
  const year = date.getUTCFullYear();
  const hours = String(date.getUTCHours()).padStart(2, "0");
  const minutes = String(date.getUTCMinutes()).padStart(2, "0");
  const seconds = String(date.getUTCSeconds()).padStart(2, "0");

  const formattedDate = `${day}/${month}/${year} ${hours}:${minutes}:${seconds}`;

  return formattedDate; // "24/05/2024 22:31:11"
}
