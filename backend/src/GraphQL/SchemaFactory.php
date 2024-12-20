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
    // Репозиторий и сервис
    $productRepository = $entityManager->getRepository('App\Entity\Product');
    $categoryRepository = $entityManager->getRepository('App\Entity\Category');
    $productService = new ProductService($productRepository, $categoryRepository);

    // Резолвер
    $productResolver = new ProductResolver($productService);

    return new Schema([
      'query' => $productResolver->getQueryType(),
      'mutation' => $productResolver->getMutationType(),
    ]);
  }
}
