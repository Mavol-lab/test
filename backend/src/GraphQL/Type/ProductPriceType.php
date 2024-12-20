<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ObjectType;

class ProductPriceType extends ObjectType
{
  public function __construct()
  {
    parent::__construct([
      'name' => 'ProductPrice',
      'fields' => [
        'id' => [
          'type' => Type::int()
        ],
        'amount' => [
          'type' => Type::float()
        ],
        'currency' => [
          'type' => new ProductPriceCurrencyType()
        ]
      ]
    ]);
  }
}
