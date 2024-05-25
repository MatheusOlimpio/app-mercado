<?php

namespace App\Models;

use App\Database\Database;
use Exception;
use PDO;

class TipoProdutoModel
{
  private PDO $conn;

  public function __construct()
  {
    $db = Database::getInstance();
    $this->conn = $db->getConnection();
  }

  public function show(): array|Exception
  {
    $sql = "SELECT A.id, tipo, B.aliquota, A.data_criacao, A.data_alteracao FROM tipo_produto AS A, imposto AS B where A.id_imposto = B.id";
    try {
      $stmt = $this->conn->prepare($sql);
      $stmt->execute();

      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $err) {
      return $err->getMessage();
    }
  }

  public function showById(int $id): array|Exception
  {
    $sql = "SELECT * FROM tipo_produto WHERE id = :id";
    try {
      $stmt = $this->conn->prepare($sql);
      $stmt->execute(['id' => $id]);

      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $err) {
      return $err->getMessage();
    }
  }

  public function exists(int $id): bool
  {
    $sql = "SELECT * FROM tipo_produto WHERE id = :id";
    try {
      $stmt = $this->conn->prepare($sql);
      $stmt->execute(['id' => $id]);

      return $stmt->rowCount() === 1 ? true : false;
    } catch (Exception $err) {
      return false;
    }
  }

  public function typeExists(string $tipo): bool
  {
    $sql = "SELECT * FROM tipo_produto WHERE tipo = :tipo";
    try {
      $stmt = $this->conn->prepare($sql);
      $stmt->execute(['tipo' => $tipo]);
      return $stmt->rowCount() === 1 ? true : false;
    } catch (Exception $err) {
      return false;
    }
  }

  public function create(array $data): bool|array
  {
    $sql = "INSERT INTO tipo_produto (tipo, id_imposto, data_criacao) VALUES (:tipo, :id_imposto, now()) RETURNING id";
    $paramValues = ['tipo' => $data['tipo'], 'id_imposto' => $data['id_imposto']];

    try {
      $stmt = $this->conn->prepare($sql);
      $stmt->execute($paramValues);

      return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $err) {
      return ['error' => $err->getMessage()];
    }
  }

  public function update(int $id, array $data): bool|array
  {
    $sql = "UPDATE tipo_produto SET tipo = :tipo, id_imposto = :id_imposto, data_alteracao = now() WHERE id = :id";
    $paramValues = ['tipo' => $data['tipo'], 'id_imposto' => $data['id_imposto'], 'id' => $id];

    try {
      $stmt = $this->conn->prepare($sql);
      $stmt->execute($paramValues);

      return $stmt->rowCount() > 0;
    } catch (Exception $err) {
      return ['error' => $err->getMessage()];
    }
  }

  public function delete(int $id): bool|array
  {
    $sql = "DELETE FROM tipo_produto WHERE id = :id";
    $paramValues = ['id' => $id];

    try {
      $stmt = $this->conn->prepare($sql);
      $stmt->execute($paramValues);

      return $stmt->rowCount() === 1;
    } catch (Exception $err) {
      return ['error' => $err->getMessage()];
    }
  }
}