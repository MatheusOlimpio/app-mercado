<?php

namespace App\Services;

class CalculaValorProdutoComEncargos
{

  public function __construct(public float $valorUnitarioTotal, public float $percentualImpostoProduto)
  {
    return $this;
  }

  public function calcular(): float
  {
    $valorComImpostos = $this->valorUnitarioTotal + round($this->valorUnitarioTotal * ($this->percentualImpostoProduto / 100), 2);
    return $valorComImpostos;
  }
}
