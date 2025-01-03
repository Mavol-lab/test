<?php

namespace App\Controller;

/**
 * Abstract base class for all controllers.
 * 
 * This class provides common functionality for all controllers in the application.
 * Extend this class to create specific controllers for handling different routes and actions. 
 */
abstract class Controller
{
    /**
     * Handles the request.
     *
     * This static method is responsible for handling the request.
     *
     * @return void
     */
    public static function handle(): void {}

    /**
     * Retrieves and decodes JSON input data from the request body.
     *
     * @return array The decoded JSON input data as an associative array.
     * @throws \InvalidArgumentException If the JSON input is invalid.
     */
    protected function getInputData(): array
    {
        $input = json_decode(file_get_contents('php://input'), true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \InvalidArgumentException("Invalid JSON input.");
        }
        return $input;
    }

    /**
     * Sends a JSON response with the given data.
     *
     * @param object $data The data to be encoded as JSON and sent in the response.
     *
     * @return void
     */
    protected function sendResponse(object $data): void
    {
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    /**
     * Sends an error response.
     *
     * @param \Throwable $e The exception to handle.
     *
     * @return void
     */
    protected function sendErrorResponse(\Throwable $e): void
    {
        header('Content-Type: application/json');
        echo json_encode(['error' => $e->getMessage()]);
    }
}
