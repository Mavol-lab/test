<?php

use FastRoute\RouteCollector;

return function (RouteCollector $r) {
    $r->post('/ProductController', [App\Controller\ProductController::class, 'handle']);
    $r->get('/ProductController', [App\Controller\ProductController::class, 'handle']);
};
