<?php

declare(strict_types=1);

namespace App\Tests;

use App\Services\CalculaValorProdutoComEncargos;
use PHPUnit\Framework\TestCase;

final class ProdutoTest extends TestCase
{
  public function testProducValueWithTax(): void
  {
    $calculaValorImposto = new CalculaValorProdutoComEncargos(3, 20);
    $valorComImpostos =  $calculaValorImposto->calcular();
    $this->assertEquals(3.6, $valorComImpostos, "O imposto foi calculado corretamente");
  }
}
