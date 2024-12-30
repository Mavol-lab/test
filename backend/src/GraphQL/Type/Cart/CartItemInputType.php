<?php

namespace App\GraphQL\Type\Cart;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\InputObjectType;

class CartItemInputType extends InputObjectType
{
  private static ?self $instance = null;

  public function __construct()
  {
    parent::__construct([
      'name' => 'CartItemInput',
      'fields' => [
        'productId' => Type::nonNull(Type::string()),
        'quantity' => Type::nonNull(Type::int()),
        'attributes' => Type::listOf(CartItemAttributeInputType::getInstance())
      ]
    ]);
  }

  public static function getInstance(): self
  {
    if (self::$instance === null) {
      self::$instance = new self();
    }

    return self::$instance;
  }
}
