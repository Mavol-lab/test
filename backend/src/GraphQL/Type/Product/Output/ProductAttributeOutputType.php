<?php

namespace App\GraphQL\Type\Product\Output;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ObjectType;

/**
 * This class represents the GraphQL output type for product attributes.
 * It extends the ObjectType class provided by the GraphQL library.
 */
class ProductAttributeOutputType extends ObjectType
{
    private static ?self $instance = null;
    protected array $fields = [];
    protected array $interfaces = [];

    public function __construct()
    {
        parent::__construct([
            'name' => 'ProductAttributeOutput',
            'fields' => [
                'id' => Type::string(),
                'name' => Type::string(),
                'type' => Type::string(),
                'items' => Type::listOf(ProductAttributeItemOutputType::getInstance())
            ]
        ]);
    }

    /**
     * Get an instance of the ProductAttributeOutputType.
     *
     * @return self An instance of the ProductAttributeOutputType.
     */
    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}