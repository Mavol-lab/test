<?php

use FastRoute\RouteCollector;

/**
 * Defines the routes for the application.
 */
return function (RouteCollector $r) {
    $r->post('/api/ProductController', [App\Controller\ProductController::class, 'handle']);
};
