<?php

use App\Controllers\ProdutoController;
use App\Controllers\TipoProdutoController;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;


return function (RoutingConfigurator $routes): void {
  $routes->add('list_products', '/products')
    ->controller([ProdutoController::class, 'show'])
    ->methods(['GET']);

  $routes->add('list_product', '/products/{id}')
    ->controller([ProdutoController::class, 'showById'])
    ->methods(['GET']);

  $routes->add('new_product', '/products')
    ->controller([ProdutoController::class, 'register'])
    ->methods(['POST']);

  $routes->add('update_product', '/products/{id}')
    ->controller([ProdutoController::class, 'update'])
    ->methods(['PUT']);

  $routes->add('delete_product', '/products/{id}')
    ->controller([ProdutoController::class, 'delete'])
    ->methods(['delete']);

  // TipoProduto
  $routes->add('type_products', '/products-type')
    ->controller([TipoProdutoController::class, 'show'])
    ->methods(['GET']);

  $routes->add('type_product', '/products/{id}')
    ->controller([TipoProdutoController::class, 'showById'])
    ->methods(['GET']);

  $routes->add('new_type_product', '/products')
    ->controller([TipoProdutoController::class, 'register'])
    ->methods(['POST']);

  $routes->add('update_type_product', '/products/{id}')
    ->controller([TipoProdutoController::class, 'update'])
    ->methods(['PUT']);

  $routes->add('delete_type_product', '/products/{id}')
    ->controller([TipoProdutoController::class, 'delete'])
    ->methods(['delete']);
};
