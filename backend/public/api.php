<?php

use App\Handlers\ExceptionHandler;
use App\Utils\ExceptionCode;
use App\Middleware\CORS;
use Dotenv\Dotenv;
use FastRoute\Dispatcher;

use function FastRoute\simpleDispatcher;

require_once __DIR__ . '/../vendor/autoload.php';

// Load configurations
Dotenv::createImmutable(__DIR__ . '/../')->load();

// Handle CORS
CORS::handle();

// Initialize router
$dispatcher = simpleDispatcher(require realpath(__DIR__ . '/../routes/routes.php'));
$routeInfo = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);

// Exception handler
set_exception_handler([ExceptionHandler::class, 'handle']);

// Sets the Content-Type header to application/json
header('Content-Type: application/json');

// Handles routing based on the first element of the $routeInfo array
switch ($routeInfo[0]) {
    case Dispatcher::NOT_FOUND:
        // Thrown when the service is not found
        throw new ExceptionCode(404, "Service not found");
    case Dispatcher::METHOD_NOT_ALLOWED:
        // Thrown when the HTTP method is not allowed
        throw new ExceptionCode(405, "Method not allowed");
    case Dispatcher::FOUND:
        [$class, $method] = $routeInfo[1];
        $vars = $routeInfo[2];
        echo call_user_func([new $class, $method], $vars);
        break;
}
