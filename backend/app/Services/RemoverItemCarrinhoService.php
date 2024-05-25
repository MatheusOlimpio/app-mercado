<?php

namespace App\Services;

use App\Models\CarrinhoItemModel;
use App\Models\ProdutoModel;
use Exception;

class RemoverItemCarrinhoService
{

  // [id_carrinho, id_produto, quantidade]
  public function remover(int $id_carrinho, int $id_item): bool|array
  {

    //adicionar item ao carrinho
    $itemCarrinho = new CarrinhoItemModel();
    $result = $itemCarrinho->delete($id_item);


    $operationError = is_array($result) && array_key_exists('error', $result);
    if ($operationError) {
      throw new Exception($result['error']);
    }

    $atualizarCarrinho = new AtualizarCarrinhoService();
    $carrinhoAtualizado = $atualizarCarrinho->refresh($id_carrinho);

    if (!$carrinhoAtualizado) {
      throw new Exception('O carrinho não foi atualizado', 500);
    }

    return $result;
  }
}