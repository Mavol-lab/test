<?php

namespace App\Handlers;

use App\Utils\ExceptionCode;

/**
 * This class is responsible for handling exceptions that occur within the application.
 * It provides mechanisms to catch, log, and respond to exceptions in a consistent manner.
 */
class ExceptionHandler
{
    /**
     * Handles the given exception.
     */
    public static function handle(ExceptionCode $exception): void
    {
        $output = [
            'errors' => [
                [
                    'message' => $exception->getMessage(),
                    'extensions' => [
                        'code' => $exception->getCode()
                    ]
                ]
            ],
            'data' => null
        ];

        echo json_encode($output);

        exit;
    }
}
