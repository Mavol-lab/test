<?php

namespace App\Handlers;

use App\Utils\ExceptionCode;

class ExceptionHandler
{
  public static function handle(ExceptionCode $exception)
  {
    if ($exception instanceof ExceptionCode) {
      http_response_code($exception->getCode());

      $message = $exception->getMessage();

      echo json_encode([
        'error' => true,
        'message' => $message ?? 'Unexpected server error'
      ]);

      exit;
    }
  }
}
