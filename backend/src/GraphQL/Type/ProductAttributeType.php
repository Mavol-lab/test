<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ObjectType;

class ProductAttributeType extends ObjectType
{
  public function __construct()
  {
    parent::__construct([
      'name' => 'ProductAttribute',
      'fields' => [
        'id' => ['type' => Type::string()],
        'name' => ['type' => Type::string()],
        'type' => ['type' => Type::string()],
        'items' => ['type' => Type::listOf(new ProductAttributeItemType())]
      ]
    ]);
  }
}
