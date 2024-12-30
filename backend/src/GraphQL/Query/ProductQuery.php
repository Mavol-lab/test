<?php

namespace App\GraphQL\Query;

use App\GraphQL\Type\Product\ProductCategoryOutputType;
use App\GraphQL\Type\Product\ProductOutputType;
use GraphQL\Type\Definition\Type;
use App\Service\ProductService;
use App\Utils\ExceptionHandlerTrait;

class ProductQuery
{
  use ExceptionHandlerTrait;

  protected ProductService $productService;

  public function __construct(ProductService $productService)
  {
    $this->productService = $productService;
  }

  public function getAll(): array
  {
    return [
      'type' => Type::listOf(ProductOutputType::getInstance()),
      'resolve' => fn($root, $args) => $this->handleExceptions(
        fn() => $this->productService->getAllProducts(),
        'Failed to fetch products'
      )
    ];
  }

  public function get(): array
  {
    return [
      'type' => ProductOutputType::getInstance(),
      'args' => [
        'id' => [
          'type' => Type::string(),
        ],
      ],
      'resolve' => fn($root, $args) => $this->handleExceptions(
        fn() => $this->productService->getProductById($args['id']),
        'Failed to fetch product'
      )
    ];
  }

  public function getCategories(): array
  {
    return [
      'type' => Type::listOf(ProductCategoryOutputType::getInstance()),
      'resolve' => fn($root, $args) => $this->handleExceptions(
        fn() => $this->productService->getAllCategories(),
        'Failed to fetch categories'
      )
    ];
  }
}
