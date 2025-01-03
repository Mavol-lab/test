<?php

namespace App\GraphQL;

use App\GraphQL\Resolver\ProductResolver;
use App\Service\ProductService;
use Doctrine\ORM\EntityManagerInterface;
use GraphQL\Type\Schema;

class SchemaFactory
{
    public static function create(EntityManagerInterface $entityManager): Schema
    {
        // Repositories
        $productRepository = $entityManager->getRepository('App\Models\Product');
        $categoryRepository = $entityManager->getRepository('App\Models\Category');
        $cartRepository = $entityManager->getRepository('App\Models\Cart');

        // Services
        $productService = new ProductService($productRepository, $categoryRepository, $cartRepository);

        // Resolvers
        $productResolver = new ProductResolver($productService);

        return new Schema([
            'query' => $productResolver->getQueryType(),
            'mutation' => $productResolver->getMutationType(),
        ]);
    }
}
