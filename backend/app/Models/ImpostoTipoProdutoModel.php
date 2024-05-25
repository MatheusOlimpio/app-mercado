<?php

namespace App\Models;

use App\Database\Database;
use Exception;
use PDO;

class ImpostoTipoProdutoModel
{
  private PDO $conn;

  public function __construct()
  {
    $db = Database::getInstance();
    $this->conn = $db->getConnection();
  }

  public function showByTipoProduto(int $id_tipo_produto): array|Exception
  {
    $sql = "SELECT * FROM tipo_produto_imposto WHERE id_tipo_produto = :id_tipo_produto";
    try {
      $stmt = $this->conn->prepare($sql);
      $stmt->execute(['id_tipo_produto' => $id_tipo_produto]);

      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $err) {
      return ['error' => $err->getMessage()];
    }
  }

  public function verifyProductTypeHasTax(int $id_tipo_produto, int $id_imposto)
  {
    $sql = "SELECT * FROM tipo_produto_imposto WHERE id_tipo_produto = :id_tipo_produto AND id_imposto = :id_imposto";
    try {
      $stmt = $this->conn->prepare($sql);
      $stmt->execute(['id_tipo_produto' => $id_tipo_produto, 'id_imposto' => $id_imposto]);
      $res =  $stmt->fetchAll();
      return count($res) > 0 ? true : false;
    } catch (Exception $err) {
      return ['error' => $err->getMessage()];
    }
  }

  public function create(array $data): bool|array
  {
    $sql = "INSERT INTO tipo_produto_imposto (id_imposto,id_tipo_produto ,data_criacao) VALUES (:id_imposto, :id_tipo_produto,now())";
    $paramValues = ['id_imposto' => $data['id_imposto'], 'id_tipo_produto' => $data['id_tipo_produto']];

    try {
      $stmt = $this->conn->prepare($sql);
      $stmt->execute($paramValues);

      return $stmt->rowCount() === 1;
    } catch (Exception $err) {
      return ['error' => $err->getMessage()];
    }
  }

  public function update(int $id, array $data): bool|array
  {
    $sql = "UPDATE tipo_produto_imposto SET id_imposto = :id_imposto, id_tipo_produto = :id_tipo_produto, data_alteracao = now() WHERE id = :id";
    $paramValues = ['id_imposto' => $data['id_imposto'], 'id_tipo_produto', 'id' => $id];

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
    $sql = "DELETE FROM tipo_produto_imposto WHERE id = :id";
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
