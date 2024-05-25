<?php

namespace App\Controllers;

use App\Services\ProdutoService;
use App\Validations\ProductValidation;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;


class ProdutoController
{
  public function show()
  {
    $produtoService = new ProdutoService();
    $response = new JsonResponse($produtoService->show());
    $response->send();
  }

  public function showById(int $id)
  {
    $produtoService = new ProdutoService();
    return json_encode($produtoService->showById($id));
  }

  public function register(Request $request)
  {

    $validation = new ProductValidation($request);
    $validated = $validation->execute();

    if ($validation->fails) {
      $response = new JsonResponse($validated, 404, []);
      $response->send();
      return false;
    }

    try {
      $service = new ProdutoService();
      $service->register($validated);

      $response = new JsonResponse(['status' => 'created'], 201);
      return $response->send();
    } catch (Exception $err) {
      $errResponse = new JsonResponse(['error' => $err->getMessage()], 500);
      return $errResponse->send();
    }
  }

  public function update(Request $request, int $id)
  {

    $validation = new ProductValidation($request);
    $validated = $validation->execute();

    if ($validation->fails) {
      $response = new JsonResponse($validated, 404, []);
      $response->send();
      return false;
    }

    try {
      $service = new ProdutoService();
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
      $service = new ProdutoService();
      $service->delete($id);

      $response = new JsonResponse(['status' => 'deleted'], 200);
      return $response->send();
    } catch (Exception $err) {
      $errResponse = new JsonResponse(['error' => $err->getMessage()], 500);
      return $errResponse->send();
    }
  }
}
