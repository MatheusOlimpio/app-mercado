<?php

namespace App\Validations;

use Symfony\Component\HttpFoundation\Request;

class CartValidation extends Validator
{
  private static self $singleton;
  private array $schema = [
    "items" => "required",
    "total_items" => "required",
    "total_preco" => "required",
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
