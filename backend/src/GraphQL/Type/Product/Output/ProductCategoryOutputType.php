<?php

namespace App\GraphQL\Type\Product\Output;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ObjectType;

/**
 * This class represents the GraphQL output type for a product category.
 * It extends the ObjectType class provided by the GraphQL library.
 */
class ProductCategoryOutputType extends ObjectType
{
    private static ?self $instance = null;
    protected array $fields = [];
    protected array $interfaces = [];

    public function __construct()
    {
        parent::__construct([
            'name' => 'ProductCategoryOutput',
            'fields' => [
                'id' => Type::nonNull(Type::int()),
                'name' => Type::string()
            ]
        ]);
    }

    /**
     * Get an instance of the ProductCategoryOutputType.
     *
     * @return self An instance of the ProductCategoryOutputType.
     */
    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}
