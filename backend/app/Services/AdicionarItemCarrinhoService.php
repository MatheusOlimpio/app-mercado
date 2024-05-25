<?php

namespace App\Services;

use App\Models\CarrinhoItemModel;
use App\Models\ProdutoModel;
use Exception;

class AdicionarItemCarrinhoService
{

  // [id_carrinho, id_produto, quantidade]
  public function adicionar(array $data, int $id_carrinho): bool|array
  {

    //verificar se o produto existe
    $produtoModel = new ProdutoModel();
    if (!$produtoModel->exists($data['id_produto'])) {
      throw new Exception('O produto não existe', 404);
    }

    // pegar o valor unitario do produto

    $productService = new ProdutoService();

    $valorUnitarioTotal = $data['quantidade'] * $productService->productUnitaryPrice($data['id_produto']);

    //adicionar item ao carrinho
    $itemCarrinho = new CarrinhoItemModel();
    $result = $itemCarrinho->create(['id_carrinho' => $id_carrinho, 'id_produto' => $data['id_produto'], 'quantidade' => $data['quantidade'], 'valor_liquido' => $valorUnitarioTotal, 'valor_total' => $data['valorTotal']]);

    $operationError = is_array($result) && array_key_exists('error', $result);
    if ($operationError) {
      throw new Exception($result['error']);
    }

    return $result;
  }
}
