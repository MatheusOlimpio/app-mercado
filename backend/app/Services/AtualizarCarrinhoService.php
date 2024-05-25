<?php

namespace App\Services;

use App\Models\CarrinhoModel;

class AtualizarCarrinhoService
{
  public function refresh(int $id_carrinho)
  {
    $carrinho = new CarrinhoModel();

    return $carrinho->sumAll($id_carrinho);
  }
}