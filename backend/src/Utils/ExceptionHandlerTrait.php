<?php

namespace App\Utils;

/**
 * A trait to handle exceptions in a standardized way across the application.
 */
trait ExceptionHandlerTrait
{
    /**
     * Handles exceptions that occur during the execution of a callback function.
     *
     * @param callable $callback The callback function to execute.
     * @param string $errorMessage The error message to use if an exception is thrown. Default is 'Operation failed'.
     * @return mixed The result of the callback function if no exception is thrown.
     * @throws \Exception If an exception occurs during the execution of the callback.
     */
    protected function handleExceptions(callable $callback, string $errorMessage = 'Operation failed')
    {
        try {
            return $callback();
        } catch (\Exception $e) {
            // Log $e->message
            throw new ExceptionCode(500, "Internal server error");
        }
    }
}
