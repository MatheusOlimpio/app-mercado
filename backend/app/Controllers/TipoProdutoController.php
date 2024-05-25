<?php

namespace App\Controllers;

use App\Services\GerenciaImpostoTipoProdutoService;
use App\Services\TipoProdutoService;
use App\Validations\ProductTypeValidation;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class TipoProdutoController
{
  public function show()
  {
    $produtoService = new TipoProdutoService();
    $response = new JsonResponse($produtoService->show());
    $response->send();
  }

  public function showById(int $id)
  {
    $tipoProdutoService = new TipoProdutoService();
    return json_encode($tipoProdutoService->showById($id));
  }

  public function register(Request $request)
  {

    $validation = new ProductTypeValidation($request);
    $validated = $validation->execute();

    if ($validation->fails) {
      $response = new JsonResponse($validated, 404, []);
      $response->send();
      return false;
    }

    try {
      $service = new TipoProdutoService();
      $service->register($validated);

      $response = new JsonResponse(['status' => 'created'], 201);
      return $response->send();
    } catch (Exception $err) {
      $errResponse = new JsonResponse(['error' => $err->getMessage()], $err->getCode() ?? 500);
      return $errResponse->send();
    }
  }

  public function update(Request $request, int $id)
  {

    $validation = new ProductTypeValidation($request);
    $validated = $validation->execute();

    if ($validation->fails) {
      $response = new JsonResponse($validated, 404, []);
      $response->send();
      return false;
    }

    try {
      $service = new TipoProdutoService();
      $service->update($id, $validated);

      $response = new JsonResponse(['status' => 'updated'], 200);
      return $response->send();
    } catch (Exception $err) {
      $errResponse = new JsonResponse(['error' => $err->getMessage()], 500);
      return $errResponse->send();
    }
  }

  public function delete(int $id)
  {
    try {
      $service = new TipoProdutoService();
      $service->delete($id);

      $response = new JsonResponse(['status' => 'deleted'], 200);
      return $response->send();
    } catch (Exception $err) {
      $errResponse = new JsonResponse(['error' => $err->getMessage()], 500);
      return $errResponse->send();
    }
  }
}