<?php

namespace App\GraphQL\Type\Product;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ObjectType;

class ProductAttributeItemOutputType extends ObjectType
{
  private static ?self $instance = null;

  public function __construct()
  {
    parent::__construct([
      'name' => 'ProductAttributeItemOutput',
      'fields' => [
        'id' => ['type' => Type::string()],
        'displayValue' => ['type' => Type::string()],
        'value' => ['type' => Type::string()]
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
