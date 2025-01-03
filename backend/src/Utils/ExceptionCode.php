<?php

namespace App\Utils;

use Exception;
use GraphQL\Error\ClientAware;

/**
 * This class extends the base Exception class and implements the ClientAware interface.
 * It is used to handle exceptions with specific codes that are aware of the client context.
 */
class ExceptionCode extends Exception implements ClientAware
{
    /**
     * @param int $code The exception code, default is 500.
     * @param string $message The exception message, default is an empty string.
     */
    public function __construct(int $code = 500, string $message = "")
    {
        parent::__construct($message, $code);
    }

    /**
     * Determines if the exception is safe to be displayed to the client.
     *
     * @return bool True if the exception is safe to be displayed to the client, false otherwise.
     */
    public function isClientSafe(): bool
    {
        return true;
    }
}
