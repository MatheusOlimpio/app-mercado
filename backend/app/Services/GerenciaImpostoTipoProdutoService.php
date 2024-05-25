<?php

namespace App\Services;

use App\Models\ImpostoModel;
use App\Models\ImpostoTipoProdutoModel;
use Exception;

class GerenciaImpostoTipoProdutoService
{

  public function showByTipoProduto(int $id_tipo_produto): array
  {
    $tipoProduto = new ImpostoTipoProdutoModel();
    $result = $tipoProduto->showByTipoProduto($id_tipo_produto);

    if (!$result) {
      return [];
    }

    return $result;
  }

  public function register(array $data): bool|array
  {

    $impostoTipoProduto = new ImpostoTipoProdutoModel();

    if ($impostoTipoProduto->verifyProductTypeHasTax($data['id_tipo_produto'], $data['id_imposto'])) {
      throw new Exception('Este imposto já está cadastrado para este registro');
    }

    $result = $impostoTipoProduto->create($data);

    $operationError = is_array($result) && array_key_exists('error', $result);
    if ($operationError) {
      throw new Exception($result['error']);
    }

    return $result;
  }

  public function delete(int $id): bool|array
  {
    $impostoTipoProduto = new ImpostoTipoProdutoModel();
    $result = $impostoTipoProduto->delete($id);

    $operationError = is_array($result) && array_key_exists('error', $result);
    if ($operationError) {
      throw new Exception($result['error']);
    }

    return $result;
  }
}
