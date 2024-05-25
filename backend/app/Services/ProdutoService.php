<?php

namespace App\Services;

use App\Models\ProdutoModel;
use App\Models\TipoProdutoModel;
use Exception;

class ProdutoService
{
  public function show(): array
  {
    $produto = new ProdutoModel();
    $result = $produto->show();

    if (!$result) {
      return [];
    }

    return $result;
  }

  public function showById(int $id): array
  {
    $produto = new ProdutoModel();
    $result = $produto->showById($id);

    if (!$result) {
      return [];
    }

    return $result;
  }

  public function productUnitaryPrice($id)
  {
    $produto = new ProdutoModel();
    $result = $produto->unitaryPrice($id);

    if (!$result) {
      return [];
    }

    return $result;
  }

  public function productTax($id)
  {
    $produto = new ProdutoModel();
    $result = $produto->valorImposto($id);

    if (!$result) {
      return [];
    }

    return $result;
  }

  public function register(array $data): bool|array
  {
    $produto = new ProdutoModel();

    $tipoProduto = new TipoProdutoModel();

    $seTipoProdutoExiste = $tipoProduto->exists($data['tipo_produto']);

    if (!$seTipoProdutoExiste) {
      throw new Exception('O tipo do produto não existe');
    }

    $result = $produto->create($data);

    $operationError = is_array($result) && array_key_exists('error', $result);
    if ($operationError) {
      throw new Exception($result['error']);
    }

    return $result;
  }

  public function update(int $id, array $data): bool|array
  {
    $produto = new ProdutoModel();
    if (!$produto->exists($id)) {
      throw new Exception('Este produto é inválido');
    }

    $tipoProduto = new TipoProdutoModel();
    $seTipoProdutoExiste = $tipoProduto->exists($data['tipo_produto']);
    if (!$seTipoProdutoExiste) {
      throw new Exception('O tipo do produto não existe');
    }

    $result = $produto->update($id, $data);
    $operationError = is_array($result) && array_key_exists('error', $result);
    if ($operationError) {
      throw new Exception($result['error']);
    }

    return $result;
  }

  public function delete(int $id): bool
  {
    $produto = new ProdutoModel();

    if (!$produto->exists($id)) {
      throw new Exception('Este produto é inválido');
    }

    $result = $produto->delete($id);

    $operationError = is_array($result) && array_key_exists('error', $result);
    if ($operationError) {
      throw new Exception($result['error']);
    }

    return $result;
  }
}
