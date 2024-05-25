<?php

namespace App\Models;

use App\Database\Database;
use Exception;
use PDO;

class ImpostoModel
{
  private PDO $conn;

  public function __construct()
  {
    $db = Database::getInstance();
    $this->conn = $db->getConnection();
  }

  public function show()
  {
    $sql = "SELECT * FROM imposto";
    try {
      $stmt = $this->conn->prepare($sql);
      $stmt->execute();

      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $err) {
      return ['error' => $err->getMessage()];
    }
  }

  public function showById(int $id)
  {
    $sql = "SELECT * FROM imposto WHERE id = :id";
    try {
      $stmt = $this->conn->prepare($sql);
      $stmt->execute(['id' => $id]);

      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $err) {
      return ['error' => $err->getMessage()];
    }
  }

  public function exists(int $id): bool
  {
    $sql = "SELECT * FROM imposto WHERE id = :id";
    try {
      $stmt = $this->conn->prepare($sql);
      $stmt->execute(['id' => $id]);
      return $stmt->rowCount() === 1 ? true : false;
    } catch (Exception $err) {
      return false;
    }
  }


  public function create(array $data)
  {
    $sql = "INSERT INTO imposto (aliquota, descricao, data_criacao) VALUES (:aliquota, :descricao,now())";
    $paramValues = ['aliquota' => $data['aliquota'], 'descricao' => $data['descricao']];

    try {
      $stmt = $this->conn->prepare($sql);
      $stmt->execute($paramValues);

      return $stmt->rowCount() === 1;
    } catch (Exception $err) {
      return ['error' => $err->getMessage()];
    }
  }

  public function update(int $id, array $data)
  {
    $sql = "UPDATE imposto SET aliquota = :aliquota, descricao = :descricao, data_alteracao = now() WHERE id = :id";
    $paramValues = ['aliquota' => $data['aliquota'], 'descricao' => $data['descricao'], 'id' => $id];

    try {
      $stmt = $this->conn->prepare($sql);
      $stmt->execute($paramValues);

      return $stmt->rowCount() === 1;
    } catch (Exception $err) {
      return ['error' => $err->getMessage()];
    }
  }

  public function delete(int $id)
  {
    $sql = "DELETE FROM imposto WHERE id = :id";
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
