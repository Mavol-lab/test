<?php

namespace App\GraphQL\Type\Product\Input;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\InputObjectType;

/**
 * This class represents the input type for product attributes in GraphQL.
 * It extends the InputObjectType class provided by the GraphQL library.
 */
class ProductAttributeInputType extends InputObjectType
{
    private static ?self $instance = null;

    public function __construct()
    {
        parent::__construct([
            'name' => 'ProductAttributeInput',
            'fields' => [
                'name' => Type::string(),
                'type' => Type::string(),
                'items' => Type::listOf(ProductAttributeItemInputType::getInstance())
            ]
        ]);
    }

    /**
     * Get an instance of the ProductAttributeInputType.
     *
     * @return self An instance of the ProductAttributeInputType.
     */
    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}
