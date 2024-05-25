<?php

namespace App\Validations;


class Validator
{
  public array $errors = [];
  public function validate(array $schema, array $requestParams): array|bool
  {

    foreach ($schema as $field => $rule) {
      $rules = explode('|', $rule);

      foreach ($rules as $rule) {
        $fieldExists = array_key_exists($field, $requestParams);
        if ($rule === 'required' && !$fieldExists) {
          $this->errors[$field] =  "O campo $field é obrigatório";
        }
      }
    }

    if (count($this->errors) === 0) {
      return true;
    }

    return $this->errors;
  }
}
