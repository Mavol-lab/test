<?php

namespace App\Middleware;

/**
 * This class handles Cross-Origin Resource Sharing (CORS) settings for the application.
 * It is responsible for setting the appropriate headers to allow or restrict access
 * to resources from different origins.
 */
final class CORS
{
    /**
     * Handles the CORS (Cross-Origin Resource Sharing) middleware.
     *
     * This method sets the necessary headers to allow cross-origin requests.
     *
     * @return void
     */
    public static function handle(): void
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, Authorization');

        $method = $_SERVER['REQUEST_METHOD'] ?? '';

        if ($method === 'OPTIONS') {
            http_response_code(204);
            exit;
        }
    }
}
