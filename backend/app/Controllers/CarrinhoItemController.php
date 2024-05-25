<?php

namespace App\Controllers;

use App\Services\AdicionarItemCarrinhoService;
use App\Services\RemoverItemCarrinhoService;
use App\Validations\ItemValidation;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class CarrinhoItemController
{

  public function __construct()
  {
  }

  public function add(Request $request, int $id)
  {

    $validation = new ItemValidation($request);
    $validated = $validation->execute();

    if ($validation->fails) {
      $response = new JsonResponse($validated, 404, []);
      $response->send();
      return false;
    }

    try {
      $addItemCarrinho = new AdicionarItemCarrinhoService();
      $addItemCarrinho->adicionar($validated, $id);

      $response = new JsonResponse(['status' => 'added'], 200);
      return $response->send();
    } catch (Exception $err) {
      $errResponse = new JsonResponse(['error' => $err->getMessage()], $err->getCode() ?? 500);
      return $errResponse->send();
    }
  }

  public function delete(int $id, int $id_item)
  {
    try {
      $addItemCarrinho = new RemoverItemCarrinhoService();
      $addItemCarrinho->remover($id, $id_item);

      $response = new JsonResponse(['status' => 'removed'], 200);
      return $response->send();
    } catch (Exception $err) {
      $errResponse = new JsonResponse(['error' => $err->getMessage()], $err->getCode() ?? 500);
      return $errResponse->send();
    }
  }
}
