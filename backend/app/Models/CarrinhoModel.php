<?php

namespace App\Models;

use App\Database\Database;
use Exception;
use PDO;

class CarrinhoModel
{
  private PDO $conn;

  public function __construct()
  {
    $db = Database::getInstance();
    $this->conn = $db->getConnection();
  }

  public function show()
  {
    $sql = "SELECT * FROM carrinho ORDER BY id DESC";
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
    $sql = "SELECT * FROM Imposto WHERE id = :id";
    try {
      $stmt = $this->conn->prepare($sql);
      $stmt->execute(['id' => $id]);

      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $err) {
      return ['error' => $err->getMessage()];
      return false;
    }
  }

  public function sumAll(int $id)
  {
    $sql = " UPDATE carrinho SET qtd_itens = total.quantidade, valor_liquido = total.valor_liquido, valor_total = total.valor_total FROM (SELECT sum(quantidade) as quantidade, sum(valor_liquido) as valor_liquido , sum(valor_total) as valor_total from public.item_carrinho WHERE id_carrinho = :id) as total where carrinho.id = :id";
    $paramValues = ['id' => $id];

    try {
      $stmt = $this->conn->prepare($sql);
      $stmt->execute($paramValues);

      return $stmt->rowCount() === 1;
    } catch (Exception $err) {
      return ['error' => $err->getMessage()];
    }
  }

  public function create(array $data): array
  {
    $sql = "INSERT INTO carrinho (qtd_itens, valor_liquido, valor_total, data_criacao) VALUES (:qtd_itens, :valor_liquido, :valor_total, now())";
    $paramValues = ['qtd_itens' => $data['qtd_itens'], 'valor_liquido' => $data['valor_liquido'], 'valor_total' => $data['valor_total']];

    try {
      $stmt = $this->conn->prepare($sql);
      $stmt->execute($paramValues);
      $id = $this->conn->lastInsertId();

      return ['id' => $id];
    } catch (Exception $err) {
      return ['error' => $err->getMessage()];
    }
  }

  public function delete(int $id)
  {
    $sql = "DELETE carrinho WHERE id = :id";
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
