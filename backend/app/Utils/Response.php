<?php

namespace App\Utils;

class Response
{
  public function json($data, $http_code)
  {
    http_response_code($http_code);
    return json_encode($data);
  }
}