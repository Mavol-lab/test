<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ObjectType;

class ProductGalleryType extends ObjectType
{
  public function __construct()
  {
    parent::__construct([
      'name' => 'ProductGallery',
      'fields' => [
        'id' => [
          'type' => Type::nonNull(Type::int())
        ],
        'imageUrl' => [
          'type' => Type::string()
        ],
        'product' => [
          'type' => ProductType::class, // Тип, представляющий продукт
        ]
      ]
    ]);
  }
}
