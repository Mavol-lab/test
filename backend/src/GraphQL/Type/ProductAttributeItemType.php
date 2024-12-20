<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ObjectType;

class ProductAttributeItemType extends ObjectType
{
  public function __construct()
  {
    parent::__construct([
      'name' => 'ProductAttributeItem',
      'fields' => [
        'id' => ['type' => Type::string()],
        'displayValue' => ['type' => Type::string()],
        'value' => ['type' => Type::string()]
      ]
    ]);
  }
}
