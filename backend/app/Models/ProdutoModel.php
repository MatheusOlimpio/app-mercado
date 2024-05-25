<?php

namespace App\Models;

use App\Database\Database;
use Exception;
use PDO;

class ProdutoModel
{
  private PDO $conn;

  public function __construct()
  {
    $db = Database::getInstance();
    $this->conn = $db->getConnection();
  }

  public function show()
  {
    $sql = "SELECT A.id, A.nome, B.tipo, A.valor, A.data_criacao, A.data_alteracao FROM produto as A, tipo_produto as B WHERE A.id_tipo = B.id;";
    try {
      $stmt = $this->conn->prepare($sql);
      $stmt->execute();

      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $err) {
      return $err->getMessage();
    }
  }

  public function showById(int $id)
  {
    $sql = "SELECT A.id, A.nome, B.tipo, A.valor, A.data_criacao, A.data_alteracao FROM produto as A, tipo_produto as B WHERE A.id_tipo = B.id AND A.id = :id";
    try {
      $stmt = $this->conn->prepare($sql);
      $stmt->execute(['id' => $id]);

      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $err) {
      return false;
    }
  }

  public function unitaryPrice(int $id)
  {
    $sql = "SELECT valor FROM produto WHERE id = :id";

    try {
      $stmt = $this->conn->prepare($sql);
      $stmt->execute(['id' => $id]);

      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

      if (!$result) {
        return false;
      }

      return $result[0]['valor'];
    } catch (Exception $err) {
      return false;
    }
  }

  public function valorImposto(int $id)
  {
    $sql = "SELECT I.aliquota as valor_imposto FROM public.tipo_produto AS T, public.imposto AS I, public.produto AS P where T.id_imposto = I.id AND P.id_tipo = T.id AND P.id = :id";

    try {
      $stmt = $this->conn->prepare($sql);
      $stmt->execute(['id' => $id]);

      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

      if (!$result) {
        return false;
      }

      return $result[0]['valor_imposto'];
    } catch (Exception $err) {
      return false;
    }
  }

  public function exists(int $id): bool
  {
    $sql = "SELECT * FROM produto WHERE id = :id";
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

    $sql = "INSERT INTO produto (id_tipo, nome, valor, data_criacao) VALUES (:tipo_produto, :nome, :valor, now())";
    $paramValues = ['tipo_produto' => $data['tipo_produto'], 'nome' => $data['nome'], 'valor' => $data['valor']];

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
    $sql = "UPDATE produto SET id_tipo = :tipo_produto, nome = :nome, valor = :valor, data_alteracao = now() WHERE id = :id";
    $paramValues = ['tipo_produto' => $data['tipo_produto'], 'nome' => $data['nome'], 'valor' => $data['valor'], 'id' => $id];

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
    $sql = "DELETE FROM produto WHERE id = :id";
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
