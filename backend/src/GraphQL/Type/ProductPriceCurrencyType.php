<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ObjectType;

class ProductPriceCurrencyType extends ObjectType
{
  public function __construct()
  {
    parent::__construct([
      'name' => 'ProductPrice',
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
}
