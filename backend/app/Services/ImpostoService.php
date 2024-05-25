<?php

namespace App\Services;

use App\Models\ImpostoModel;
use Exception;

class ImpostoService
{
  public function show(): array
  {
    $tipoProduto = new ImpostoModel();
    $result = $tipoProduto->show();

    if (!$result) {
      return [];
    }

    return $result;
  }

  public function showById(int $id): array
  {
    $tipoProduto = new ImpostoModel();
    $result = $tipoProduto->showById($id);

    if (!$result) {
      return [];
    }

    return $result;
  }

  public function register(array $data): bool|array
  {

    $imposto = new ImpostoModel();

    $result = $imposto->create($data);

    $operationError = is_array($result) && array_key_exists('error', $result);
    if ($operationError) {
      throw new Exception($result['error']);
    }

    return $result;
  }

  public function update(int $id, array $data): bool|array
  {
    $imposto = new ImpostoModel();
    $result = $imposto->update($id, $data);

    $operationError = is_array($result) && array_key_exists('error', $result);
    if ($operationError) {
      throw new Exception($result['error']);
    }

    return $result;
  }

  public function delete(int $id): bool|array
  {
    $imposto = new ImpostoModel();
    $result = $imposto->delete($id);

    $operationError = is_array($result) && array_key_exists('error', $result);
    if ($operationError) {
      throw new Exception($result['error']);
    }

    return $result;
  }
}
