<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class ProductType extends ObjectType
{
  public function __construct()
  {
    parent::__construct([
      'name' => 'Product',
      'fields' => [
        'id' => [
          'type' => Type::nonNull(Type::string())
        ],
        'name' => [
          'type' => Type::string()
        ],
        'inStock' => [
          'type' => Type::boolean()
        ],
        'description' => [
          'type' => Type::string()
        ],
        'brand' => [
          'type' => Type::string()
        ],
        'gallery' => [
          'type' => Type::listOf(new ProductGalleryType())
        ],
        'category' => [
          'type' => new ProductCategoryType()
        ],
        'prices' => [
          'type' => Type::listOf(new ProductPriceType())
        ],
        'attributes' => [
          'type' => Type::listOf(new ProductAttributeType())
        ],
      ]
    ]);
  }
}
