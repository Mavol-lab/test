<?php

namespace App\GraphQL\Type\Product;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ObjectType;

class ProductGalleryOutputType extends ObjectType
{
  private static ?self $instance = null;

  public function __construct()
  {
    parent::__construct([
      'name' => 'ProductGalleryOutput',
      'fields' => function () {
        return [
          'id' => [
            'type' => Type::nonNull(Type::int()),
          ],
          'imageUrl' => [
            'type' => Type::string(),
          ],
          'product' => [
            'type' => ProductOutputType::getInstance(), // Отложенное создание
          ],
        ];
      },
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
