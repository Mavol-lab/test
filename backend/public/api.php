<?php

use App\Handlers\ExceptionHandler;
use App\Utils\ExceptionCode;
use App\Config\ConfigLoader;
use App\Middleware\CORS;

require_once __DIR__ . '/../vendor/autoload.php';

// Load configurations
ConfigLoader::load(__DIR__);

// Handle CORS
CORS::handle();

// Initialize router
$dispatcher = FastRoute\simpleDispatcher(require __DIR__ . '/../routes/routes.php');
$routeInfo = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);

// Exception handler
set_exception_handler([ExceptionHandler::class, 'handle']);

switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        throw new ExceptionCode(404, "Service not found");
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        throw new ExceptionCode(405, "Method not allowed");
    case FastRoute\Dispatcher::FOUND:
        [$class, $method] = $routeInfo[1];
        $vars = $routeInfo[2];
        echo call_user_func([new $class, $method], $vars);
        break;
}
