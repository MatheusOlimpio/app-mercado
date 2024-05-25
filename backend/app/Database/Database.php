<?php

namespace App\Database;

require __DIR__ . '/../../loaddotenv.php';

use Exception;
use PDO;

class Database
{
  private static $instance = null;
  private $conn;

  private $host;
  private $username;
  private $password;
  private $db;

  public function __construct()
  {
    $this->host = getenv('DB_HOST');
    $this->username = getenv('DB_USERNAME'); // Corrigido de 'DB_USER' para 'DB_USERNAME'
    $this->password = getenv('DB_PASSWORD'); // Corrigido de 'DB_PASS' para 'DB_PASSWORD'
    $this->db = getenv('DB_NAME');


    try {
      $this->conn = new PDO("pgsql:host=$this->host;port=5432;dbname=$this->db;", $this->username, $this->password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    } catch (Exception $err) {
      echo 'Ocorreu um erro ao conectar no banco de dados';
    }
  }

  public static function getInstance(): Database
  {
    if (!self::$instance) {
      self::$instance = new Database();
    }

    return self::$instance;
  }

  public function getConnection(): PDO
  {
    return $this->conn;
  }
}
