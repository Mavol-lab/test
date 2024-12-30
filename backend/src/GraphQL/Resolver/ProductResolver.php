<?php

namespace App\GraphQL\Resolver;

use App\GraphQL\Mutation\CartMutation;
use App\GraphQL\Query\ProductQuery;
use App\GraphQL\Type\Cart\CartItemInputType;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ObjectType;
use App\Service\ProductService;
use GraphQL\Type\Definition\InputObjectType;

class ProductResolver
{
  private ProductService $productService;

  public function __construct(ProductService $productService)
  {
    $this->productService = $productService;
  }

  public function getQueryType(): ObjectType
  {
    $productQuery = new ProductQuery($this->productService);

    return new ObjectType([
      'name' => 'Query',
      'fields' => [
        'categories' => $productQuery->getCategories(),
        'products' => $productQuery->getAll(),
        'product' => $productQuery->get(),
      ]
    ]);
  }

  public function getMutationType(): ObjectType
  {
    $cartMutation = new CartMutation($this->productService);

    return new ObjectType([
      'name' => 'Mutation',
      'fields' => [
        'addToCart' => $cartMutation->add()
      ],
    ]);
  }
}
