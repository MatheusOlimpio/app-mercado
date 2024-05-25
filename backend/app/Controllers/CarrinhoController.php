<?php

namespace App\Controllers;

use App\Services\CarrinhoService;
use App\Validations\CartValidation;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class CarrinhoController
{

  public function __construct()
  {
  }


  public function show()
  {
    $carrinho = new CarrinhoService();
    $response = new JsonResponse($carrinho->show());
    $response->send();
  }
  public function save(Request $request)
  {
    $validation = new CartValidation($request);
    $validated = $validation->execute();

    if ($validation->fails) {
      $response = new JsonResponse($validated, 404, []);
      $response->send();
      return false;
    }

    try {
      $carrinho = new CarrinhoService();
      $carrinho->save($validated);


      $response = new JsonResponse(['status' => 'created'], 201);
      return $response->send();
    } catch (Exception $err) {
      $errResponse = new JsonResponse(['error' => $err->getMessage()], 500);
      return $errResponse->send();
    }
  }
}
