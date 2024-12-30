<?php

namespace App\GraphQL\Type\Product;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ObjectType;

class ProductAttributeOutputType extends ObjectType
{
  private static ?self $instance = null;

  public function __construct()
  {
    parent::__construct([
      'name' => 'ProductAttributeOutput',
      'fields' => [
        'id' => ['type' => Type::string()],
        'name' => ['type' => Type::string()],
        'type' => ['type' => Type::string()],
        'items' => ['type' => Type::listOf(ProductAttributeItemOutputType::getInstance())]
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
