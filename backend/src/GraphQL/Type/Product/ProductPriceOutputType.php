<?php

namespace App\GraphQL\Type\Product;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ObjectType;

class ProductPriceOutputType extends ObjectType
{
  private static ?self $instance = null;

  public function __construct()
  {
    parent::__construct([
      'name' => 'ProductPriceOutput',
      'fields' => [
        'id' => [
          'type' => Type::int()
        ],
        'amount' => [
          'type' => Type::float()
        ],
        'currency' => [
          'type' => ProductPriceCurrencyOutputType::getInstance()
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
