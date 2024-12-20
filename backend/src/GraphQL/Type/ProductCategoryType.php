<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ObjectType;

class ProductCategoryType extends ObjectType
{
  public function __construct()
  {
    parent::__construct([
      'name' => 'Category',
      'fields' => [
        'id' => [
          'type' => Type::nonNull(Type::int())
        ],
        'name' => [
          'type' => Type::string()
        ]
      ]
    ]);
  }
}
