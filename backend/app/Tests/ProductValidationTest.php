<?php

// tests/Validations/ProductValidationTest.php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use App\Validations\ProductValidation;

class ProductValidationTest extends TestCase
{
  public function testValidationSuccess()
  {
    $requestData = json_encode([
      'tipo_produto' => 1,
      'nome' => 'Notebook',
      'valor' => 3000
    ]);

    $request = Request::create(
      '/test',
      'POST',
      [],
      [],
      [],
      ['CONTENT_TYPE' => 'application/json'],
      $requestData
    );

    $validator = new ProductValidation($request);
    $result = $validator->execute();

    $this->assertFalse($validator->fails);
    $this->assertEquals([
      'tipo_produto' => 1,
      'nome' => 'Notebook',
      'valor' => 3000
    ], $result);
  }

  public function testValidationFails()
  {
    $requestData = json_encode([
      'nome' => 'Notebook'
    ]);

    $request = Request::create(
      '/test',
      'POST',
      [],
      [],
      [],
      ['CONTENT_TYPE' => 'application/json'],
      $requestData
    );

    $validator = new ProductValidation($request);
    $result = $validator->execute();

    $this->assertTrue($validator->fails);
    $this->assertArrayHasKey('errors', $result);
    $this->assertArrayHasKey('tipo_produto', $result['errors']);
    $this->assertArrayHasKey('valor', $result['errors']);
  }
}
