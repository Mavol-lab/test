<?php

namespace App\Controller;

use App\Controller\Controller;
use App\Managers\DoctrineManager;
use App\GraphQL\SchemaFactory;
use GraphQL\GraphQL;

/**
 * This is the controller class for handling product-related actions.
 * It extends the base Controller class.
 */
final class ProductController extends Controller
{
    public static function handle(): void
    {
        // This code reads the raw data from the 'php://input' stream 
        // and decodes it into a PHP associative array.
        $input = json_decode(file_get_contents('php://input'), true);
        $query = $input['query'];
        $variables = $input['variables'] ?? null;

        $em = DoctrineManager::getEntityManager();

        $schema = SchemaFactory::create($em);
        $result = GraphQL::executeQuery($schema, $query, null, null, $variables);

        echo json_encode($result->toArray());
    }
}
