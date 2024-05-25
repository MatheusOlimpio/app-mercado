<?php
// tests/Validations/TaxValidationTest.php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use App\Validations\TaxValidation;

class TaxValidationTest extends TestCase
{
  public function testValidationSuccess()
  {
    $requestData = json_encode([
      'aliquota' => 5,
      'descricao' => 'Descrição válida'
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

    $validator = new TaxValidation($request);
    $result = $validator->execute();

    $this->assertFalse($validator->fails);
    $this->assertEquals([
      'aliquota' => 5,
      'descricao' => 'Descrição válida'
    ], $result);
  }

  public function testValidationFails()
  {
    $requestData = json_encode([
      'descricao' => 'Descrição válida'
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

    $validator = new TaxValidation($request);
    $result = $validator->execute();

    $this->assertTrue($validator->fails);
    $this->assertArrayHasKey('errors', $result);
    $this->assertArrayHasKey('aliquota', $result['errors']);
  }
}
