<?php

namespace App\GraphQL\Mutation;

use App\GraphQL\Type\Cart\CartItemInputType;
use GraphQL\Type\Definition\Type;
use App\Service\ProductService;
use App\Utils\ExceptionHandlerTrait;

class CartMutation
{
  use ExceptionHandlerTrait;

  protected ProductService $productService;

  public function __construct(ProductService $productService)
  {
    $this->productService = $productService;
  }

  public function add(): array
  {
    return [
      'type' => Type::boolean(),
      'args' => [
        'cartItems' => Type::listOf(CartItemInputType::getInstance())
      ],
      'resolve' => function ($root, $args) {
        return $this->productService->addToCart($args['cartItems']);
      }
    ];
  }
}
