<?php

namespace App\Services;

use App\Models\ImpostoModel;
use App\Models\TipoProdutoModel;
use Exception;

class TipoProdutoService
{
  public function show(): array
  {
    $tipoProduto = new TipoProdutoModel();
    $result = $tipoProduto->show();

    if (!$result) {
      return [];
    }

    return $result;
  }

  public function showById(int $id): array
  {
    $tipoProduto = new TipoProdutoModel();
    $result = $tipoProduto->showById($id);

    if (!$result) {
      return [];
    }

    return $result;
  }

  public function register(array $data): bool|array
  {
    $tipoProduto = new TipoProdutoModel();
    $tipoProdutoExiste = $tipoProduto->typeExists($data['tipo']);
    if ($tipoProdutoExiste) {
      throw new Exception('Este tipo de produto já existe.');
    }

    $imposto = new ImpostoModel();
    $impostoCadastrado = $imposto->exists($data['id_imposto']);

    if (!$impostoCadastrado) {
      throw new Exception('Imposto e inválido');
    }

    $result = $tipoProduto->create($data);
    $operationError = is_array($result) && array_key_exists('error', $result);
    if ($operationError) {
      throw new Exception($result['error']);
    }

    return $result;
  }

  public function update(int $id, array $data): bool|array
  {
    $tipoProduto = new TipoProdutoModel();

    $tipoProdutoExiste = $tipoProduto->exists($id);

    if (!$tipoProdutoExiste) {
      throw new Exception('Não é possivel atualizar o produto');
    }

    $imposto = new ImpostoModel();
    $impostoCadastrado = $imposto->exists($data['id_imposto']);

    if (!$impostoCadastrado) {
      throw new Exception('O imposto é inválido');
    }

    $result = $tipoProduto->update($id, $data);

    return $result;
  }

  public function delete(int $id): bool
  {
    $tipoProduto = new TipoProdutoModel();

    if (!$tipoProduto->exists($id)) {
      throw new Exception('Este tipo de produto é inválido');
    }

    $result = $tipoProduto->delete($id);

    $operationError = is_array($result) && array_key_exists('error', $result);
    if ($operationError) {
      throw new Exception($result['error']);
    }

    return $result;
  }
}