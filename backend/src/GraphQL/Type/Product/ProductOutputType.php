<?php

namespace App\GraphQL\Type\Product;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class ProductOutputType extends ObjectType
{
  private static ?self $instance = null;

  public function __construct()
  {
    parent::__construct([
      'name' => 'ProductOutput',
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
          'type' => Type::listOf(ProductGalleryOutputType::getInstance())
        ],
        'category' => [
          'type' => ProductCategoryOutputType::getInstance()
        ],
        'prices' => [
          'type' => Type::listOf(ProductPriceOutputType::getInstance())
        ],
        'attributes' => [
          'type' => Type::listOf(ProductAttributeOutputType::getInstance())
        ],
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
