<?php

namespace App\Services;

use App\Models\CarrinhoModel;
use Exception;

class CarrinhoService
{

  public function __construct()
  {
  }


  public function show()
  {

    $model = new CarrinhoModel();
    $result = $model->show();

    if (!$result) {
      return [];
    }

    return $result;
  }

  public function save(array $data)
  {
    $model = new CarrinhoModel();
    $result = $model->create(['qtd_itens' => $data['total_items'], 'valor_liquido' => 0, 'valor_total' => $data['total_preco']]);

    $operationError = is_array($result) && array_key_exists('error', $result);
    if ($operationError) {
      throw new Exception($result['error']);
    }

    foreach ($data['items'] as $item) {
      $items = new AdicionarItemCarrinhoService();
      $items->adicionar(['id_produto' => $item['id'], 'quantidade' => $item['quantidade'], 'valorTotal' => $item['valorTotal']], $result['id']);
    }
    return $result;
  }
}
