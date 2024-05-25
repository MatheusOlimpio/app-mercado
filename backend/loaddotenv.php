<?php
// Carregar variáveis de ambiente
$envFilePath = __DIR__ . '/.env';
if (file_exists($envFilePath)) {
  $lines = file($envFilePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
  foreach ($lines as $line) {
    if (strpos($line, '=') !== false && substr($line, 0, 1) !== '#') {
      list($key, $value) = explode('=', $line, 2);
      putenv("$key=$value");
      $_ENV[$key] = $value;
      $_SERVER[$key] = $value;
    }
  }
} else {
  die('.env file not found');
}
