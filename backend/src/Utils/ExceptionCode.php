<?php

namespace App\Utils;

use Exception;

class ExceptionCode extends Exception
{
  public function __construct(?int $code = 500, ?string $message = null)
  {
    parent::__construct($message, $code);
  }
}
