<?php

namespace App\GraphQL\Resolver;

use App\GraphQL\Type\ProductCategoryType;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ObjectType;
use App\Service\ProductService;
use App\GraphQL\Type\ProductType;

class ProductResolver
{
  private ProductService $productService;

  public function __construct(ProductService $productService)
  {
    $this->productService = $productService;
  }

  public function getQueryType(): ObjectType
  {
    return new ObjectType([
      'name' => 'Query',
      'fields' => [
        'products' => [
          'type' => Type::listOf(new ProductType()),
          'resolve' => function () {
            try {
              return $this->productService->getAllProducts();
            } catch (\Exception $e) {
              throw new \Exception("Failed to fetch products");
            }
          }
        ],
        'categories' => [
          'type' => Type::listOf(new ProductCategoryType()),
          'resolve' => function () {
            try {
              return $this->productService->getAllCategories();
            } catch (\Exception $e) {
              throw new \Exception("Failed to fetch categories");
            }
          }
        ],
        'product' => [
          'type' => new ProductType(),
          'args' => [
            'id' => [
              'type' => Type::string(),
            ],
          ],
          'resolve' => function ($root, $args) {
            try {
              return $this->productService->getProductById($args['id']);
            } catch (\Exception $e) {
              throw new \Exception("Failed to fetch product with ID: {$args['id']}");
            }
          }
        ],
      ]
    ]);
  }

  public function getMutationType(): ObjectType
  {
    return new ObjectType([
      'name' => 'Mutation',
      'fields' => [
        'addProduct' => [
          'type' => Type::string(), // Укажите ваш `ProductType`
          'args' => [
            'name' => ['type' => Type::string()],
            'price' => ['type' => Type::float()],
            'description' => ['type' => Type::string()],
          ],
          'resolve' => function ($root, $args) {
            return $this->productService->addProduct($args);
          }
        ],
      ]
    ]);
  }
}
