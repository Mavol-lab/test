<?php

namespace App\GraphQL\Type\Product;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ObjectType;

class ProductPriceCurrencyOutputType extends ObjectType
{
  private static ?self $instance = null;

  public function __construct()
  {
    parent::__construct([
      'name' => 'ProductPriceCurrencyOutput',
      'fields' => [
        'id' => [
          'type' => Type::int()
        ],
        'label' => [
          'type' => Type::string()
        ],
        'symbol' => [
          'type' => Type::string()
        ]
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
