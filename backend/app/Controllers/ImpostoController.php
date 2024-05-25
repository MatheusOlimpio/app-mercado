<?php

namespace App\Controllers;

use App\Services\ImpostoService;
use App\Validations\TaxValidation;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Exception;

class ImpostoController
{
  public function show()
  {
    $impostoProdutoService = new ImpostoService();
    $response = new JsonResponse($impostoProdutoService->show(), 200);
    return $response->send();
  }

  public function showById(int $id)
  {
    $impostoProdutoService = new ImpostoService();

    $response = new JsonResponse($impostoProdutoService->showById($id), 200);
    return $response->send();
  }

  public function register(Request $request)
  {

    $validation = new TaxValidation($request);
    $validated = $validation->execute();

    if ($validation->fails) {
      $response = new JsonResponse($validated, 404, []);
      $response->send();
      return false;
    }

    try {
      $service = new ImpostoService();
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

    $validation = new TaxValidation($request);
    $validated = $validation->execute();

    if ($validation->fails) {
      $response = new JsonResponse($validated, 404, []);
      $response->send();
      return false;
    }

    try {
      $service = new ImpostoService();
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
      $service = new ImpostoService();
      $service->delete($id);

      $response = new JsonResponse(['status' => 'deleted'], 200);
      return $response->send();
    } catch (Exception $err) {
      $errResponse = new JsonResponse(['error' => $err->getMessage()], 500);
      return $errResponse->send();
    }
  }
}
