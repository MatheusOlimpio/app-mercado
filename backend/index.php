<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
// Inclua o autoload do Composer

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing;
use Symfony\Component\HttpKernel;

require __DIR__ . '/vendor/autoload.php';

$routes = new RouteCollection();
$routes->add('products', new Routing\Route('/products', ['_controller' => 'App\Controllers\ProdutoController::show'], [], [], '', [], ['GET']));
$routes->add('product', new Routing\Route('/products/{id}', ['_controller' => 'App\Controllers\ProdutoController::showById'], [], [], '', [], ['GET']));
$routes->add('new_product', new Routing\Route('/products', ['_controller' => 'App\Controllers\ProdutoController::register'], [], [], '', [], ['POST']));
$routes->add('update_product', new Routing\Route('/products/{id}', ['_controller' => 'App\Controllers\ProdutoController::update'], [], [], '', [], ['PUT']));
$routes->add('delete_product', new Routing\Route('/products/{id}', ['_controller' => 'App\Controllers\ProdutoController::delete'], [], [], '', [], ['DELETE']));

$routes->add('products-types', new Routing\Route('/type-products', ['_controller' => 'App\Controllers\TipoProdutoController::show'], [], [], '', [], ['GET']));
$routes->add('products-type', new Routing\Route('/type-products/{id}', ['_controller' => 'App\Controllers\TipoProdutoController::showById'], [], [], '', [], ['GET']));
$routes->add('new-product-type', new Routing\Route('/type-products', ['_controller' => 'App\Controllers\TipoProdutoController::register'], [], [], '', [], ['POST']));
$routes->add('update-product-type', new Routing\Route('/type-products/{id}', ['_controller' => 'App\Controllers\TipoProdutoController::update'], [], [], '', [], ['PUT']));
$routes->add('delete-product-type', new Routing\Route('/type-products/{id}', ['_controller' => 'App\Controllers\TipoProdutoController::delete'], [], [], '', [], ['DELETE']));

$routes->add('taxes', new Routing\Route('/taxes', ['_controller' => 'App\Controllers\ImpostoController::show'], [], [], '', [], ['GET']));
$routes->add('tax', new Routing\Route('/taxes/{id}', ['_controller' => 'App\Controllers\ImpostoController::showById'], [], [], '', [], ['GET']));
$routes->add('new-tax', new Routing\Route('/taxes', ['_controller' => 'App\Controllers\ImpostoController::register'], [], [], '', [], ['POST']));
$routes->add('update-tax', new Routing\Route('/taxes/{id}', ['_controller' => 'App\Controllers\ImpostoController::update'], [], [], '', [], ['PUT']));
$routes->add('delete-tax', new Routing\Route('/taxes/{id}', ['_controller' => 'App\Controllers\ImpostoController::delete'], [], [], '', [], ['DELETE']));

$routes->add('show', new Routing\Route('/cart', ['_controller' => 'App\Controllers\CarrinhoController::show'], [], [], '', [], ['GET']));
$routes->add('add-cart', new Routing\Route('/cart', ['_controller' => 'App\Controllers\CarrinhoController::save'], [], [], '', [], ['POST']));

$routes->add('add-item-cart', new Routing\Route('/cart/{id}/items', ['_controller' => 'App\Controllers\CarrinhoItemController::add'], [], [], '', [], ['POST']));
$routes->add('delete-item-cart', new Routing\Route('/cart/{id}/items/{id_item}', ['_controller' => 'App\Controllers\CarrinhoItemController::delete'], [], [], '', [], ['DELETE']));

$request = Request::createFromGlobals();

$context = new Routing\RequestContext();
$context->fromRequest($request);
$matcher = new Routing\Matcher\UrlMatcher($routes, $context);

$controllerResolver = new HttpKernel\Controller\ControllerResolver();
$argumentResolver = new HttpKernel\Controller\ArgumentResolver();

try {
    $request->attributes->add($matcher->match($request->getPathInfo()));

    $controller = $controllerResolver->getController($request);
    $arguments = $argumentResolver->getArguments($request, $controller);

    $response = call_user_func_array($controller, $arguments);
} catch (Routing\Exception\ResourceNotFoundException $exception) {

    $response = new Response('Not Found', 404);
} catch (Exception $exception) {
    $response = new Response('An error occurred', 500);
}
