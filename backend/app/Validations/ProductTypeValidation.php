<?php

namespace App\Validations;

use Symfony\Component\HttpFoundation\Request;

class ProductTypeValidation extends Validator
{
  private static self $singleton;
  private array $schema = [
    "tipo" => "required",
    "id_imposto" => "required"
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
