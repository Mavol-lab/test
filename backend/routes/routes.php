<?php

use FastRoute\RouteCollector;

return function (RouteCollector $r) {
    $r->post('/api/ProductController', [App\Controller\ProductController::class, 'handle']);
    $r->get('/api/ProductController', [App\Controller\ProductController::class, 'handle']);
};
