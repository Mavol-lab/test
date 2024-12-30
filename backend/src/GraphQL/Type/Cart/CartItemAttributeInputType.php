<?php

namespace App\GraphQL\Type\Cart;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\InputObjectType;

class CartItemAttributeInputType extends InputObjectType
{
  private static ?self $instance = null;

  public function __construct()
  {
    parent::__construct([
      'name' => 'CartItemAttributeInput',
      'fields' => [
        'name' => Type::nonNull(Type::string()),
        'value' => Type::nonNull(Type::string())
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
