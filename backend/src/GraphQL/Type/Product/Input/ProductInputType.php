<?php

namespace App\GraphQL\Type\Product\Input;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\InputObjectType;

/**
 * This class represents the input type for a Product in GraphQL.
 * It extends the InputObjectType class provided by the GraphQL library.
 */
class ProductInputType extends InputObjectType
{
    private static ?self $instance = null;

    public function __construct()
    {
        parent::__construct([
            'name' => 'ProductInput',
            'fields' => [
                'name' => Type::string(),
                'inStock' => Type::boolean(),
                'description' => Type::string(),
                'brand' => Type::string(),
                'gallery' => Type::listOf(ProductGalleryInputType::getInstance()),
                'categoryId' => Type::string(),
                'prices' => Type::listOf(ProductPriceInputType::getInstance()),
                'attributes' => Type::listOf(ProductAttributeInputType::getInstance()),
            ]
        ]);
    }

    /**
     * Get an instance of the ProductInputType.
     *
     * @return self An instance of the ProductInputType.
     */
    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}
