<?php

namespace App\Utils;

trait ExceptionHandlerTrait
{
  protected function handleExceptions(callable $callback, string $errorMessage = 'Operation failed')
  {
    try {
      return $callback();
    } catch (\Exception $e) {
      throw new \Exception($errorMessage, 0, $e);
    }
  }
}
