<?php

namespace App\Tests\Services;

use PHPUnit\Framework\TestCase;
use App\Services\CalculaValorProdutoComEncargos;

class CalculaValorProdutoComEncargosTest extends TestCase
{
  public function testCalculoValorComImposto()
  {
    $valorUnitarioTotal = 100.00;
    $percentualImpostoProduto = 20.0; // 20%

    $calculadora = new CalculaValorProdutoComEncargos($valorUnitarioTotal, $percentualImpostoProduto);
    $valorCalculado = $calculadora->calcular();

    $this->assertEquals(120.00, $valorCalculado);
  }

  public function testCalculoValorComImpostoArredondado()
  {
    $valorUnitarioTotal = 99.99;
    $percentualImpostoProduto = 15.0; // 15%

    $calculadora = new CalculaValorProdutoComEncargos($valorUnitarioTotal, $percentualImpostoProduto);
    $valorCalculado = $calculadora->calcular();

    $this->assertEquals(114.99, $valorCalculado);
  }

  public function testCalculoValorComImpostoZero()
  {
    $valorUnitarioTotal = 100.00;
    $percentualImpostoProduto = 0.0; // 0%

    $calculadora = new CalculaValorProdutoComEncargos($valorUnitarioTotal, $percentualImpostoProduto);
    $valorCalculado = $calculadora->calcular();

    $this->assertEquals(100.00, $valorCalculado);
  }
}
