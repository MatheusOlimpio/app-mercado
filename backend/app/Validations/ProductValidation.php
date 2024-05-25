<?php

namespace App\Validations;

use Symfony\Component\HttpFoundation\Request;

class ProductValidation extends Validator
{
  private static self $singleton;
  private array $schema = [
    "tipo_produto" => "required",
    "nome" => "required",
    "valor" => "required",
  ];

  private array $params = [];
  public bool $fails = false;


  public function __construct(Request $request)
  {
    $this->params = $request->toArray();
  }


  public function execute(): array
  {

    $validated = $this->validate($this->schema, $this->params);

    if ($this->errors) {

      $this->fails = true;
      return ['errors' => $validated];
    }

    return $this->params;
  }
}
