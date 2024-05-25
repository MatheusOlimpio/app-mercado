<?php

namespace App\Models;

use App\Database\Database;
use Exception;
use PDO;

class CarrinhoItemModel
{
  private PDO $conn;

  public function __construct()
  {
    $db = Database::getInstance();
    $this->conn = $db->getConnection();
  }

  public function show()
  {
    $sql = "SELECT * FROM item_carrinho";
    try {
      $stmt = $this->conn->prepare($sql);
      $stmt->execute();

      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $err) {
      return false;
    }
  }

  public function showByCarrinho(int $id_carrinho)
  {
    $sql = "SELECT * FROM item_carrinho WHERE id_carrinho = :id_carrinho";
    try {
      $stmt = $this->conn->prepare($sql);
      $stmt->execute(['id_carrinho' => $id_carrinho]);

      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $err) {
      return false;
    }
  }

  public function showById(int $id)
  {
    $sql = "SELECT * FROM item_carrinho WHERE id = :id";
    try {
      $stmt = $this->conn->prepare($sql);
      $stmt->execute(['id' => $id]);

      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $err) {
      return false;
    }
  }

  public function create(array $data)
  {
    $sql = "INSERT INTO item_carrinho (id_carrinho, id_produto, quantidade, valor_liquido, valor_total, data_criacao) VALUES (:id_carrinho, :id_produto, :quantidade, :valor_liquido, :valor_total, now())";
    $paramValues = ['id_carrinho' => $data['id_carrinho'], 'id_produto' => $data['id_produto'], 'quantidade' => $data['quantidade'], 'valor_liquido' => $data['valor_liquido'], 'valor_total' => $data['valor_total']];

    try {
      $stmt = $this->conn->prepare($sql);
      $stmt->execute($paramValues);

      return $stmt->rowCount() === 1;
    } catch (Exception $err) {
      return ['error' => $err];
    }
  }

  public function delete(int $id)
  {
    $sql = "DELETE FROM item_carrinho WHERE id = :id";
    $paramValues = ['id' => $id];

    try {
      $stmt = $this->conn->prepare($sql);
      $stmt->execute($paramValues);

      return $stmt->rowCount() === 1;
    } catch (Exception $err) {
      return false;
    }
  }
}
