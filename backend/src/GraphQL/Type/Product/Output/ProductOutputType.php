<?php

namespace App\GraphQL\Type\Product\Output;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

/**
 * This class represents the GraphQL output type for a Product.
 * It extends the ObjectType class to define the structure of the Product type in the GraphQL schema.
 */
class ProductOutputType extends ObjectType
{
    private static ?self $instance = null;
    protected array $fields = [];
    protected array $interfaces = [];

    public function __construct()
    {
        parent::__construct([
            'name' => 'ProductOutput',
            'fields' => [
                'id' => Type::nonNull(Type::string()),
                'name' => Type::string(),
                'inStock' => Type::boolean(),
                'description' => Type::string(),
                'brand' => Type::string(),
                'gallery' => Type::listOf(ProductGalleryOutputType::getInstance()),
                'category' => ProductCategoryOutputType::getInstance(),
                'prices' => Type::listOf(ProductPriceOutputType::getInstance()),
                'attributes' => Type::listOf(ProductAttributeOutputType::getInstance()),
            ]
        ]);
    }

    /**
     * Get an instance of the ProductOutputType.
     *
     * @return self An instance of the ProductOutputType.
     */
    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}
