<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config/doctrine_config.php';
require_once __DIR__ . '/config/purifier_config.php';





$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
    $r->post('/ProductController', [App\Controller\ProductController::class, 'handle']);
    $r->get('/ProductController', [App\Controller\ProductController::class, 'handle']);
});

$routeInfo = $dispatcher->dispatch(
    $_SERVER['REQUEST_METHOD'],
    $_SERVER['REQUEST_URI']
);

try {
    switch ($routeInfo[0]) {
        case FastRoute\Dispatcher::NOT_FOUND:
            http_response_code(404);
            exit;
            break;
        case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
            $allowedMethods = $routeInfo[1];
            http_response_code(405);
            exit;
            break;
        case FastRoute\Dispatcher::FOUND:
            $handler = $routeInfo[1];
            $vars = $routeInfo[2];
            echo $handler($vars);
            break;
    }
} catch (Exception $e) {
    // Отправляем ошибку в формате JSON
    http_response_code($e->getCode());
    echo json_encode([
        'error' => true,
        'message' => $e->getMessage(),
    ]);
}
