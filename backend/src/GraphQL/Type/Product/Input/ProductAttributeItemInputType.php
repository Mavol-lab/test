<?php

namespace App\GraphQL\Type\Product\Input;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\InputObjectType;

/**
 * This class represents the input type for product attribute items in GraphQL.
 * It extends the InputObjectType class to define the structure of the input
 * for product attribute items.
 */
class ProductAttributeItemInputType extends InputObjectType
{
    private static ?self $instance = null;

    public function __construct()
    {
        parent::__construct([
            'name' => 'ProductAttributeItemInput',
            'fields' => [
                'displayValue' => Type::string(),
                'value' => Type::string()
            ]
        ]);
    }

    /**
     * Get an instance of the ProductAttributeItemInputType.
     *
     * @return self An instance of the ProductAttributeItemInputType.
     */
    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}
