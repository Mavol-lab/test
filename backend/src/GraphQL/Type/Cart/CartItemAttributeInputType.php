<?php

namespace App\GraphQL\Type\Cart;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\InputObjectType;

/**
 * This class represents the input type for cart item attributes in GraphQL.
 * It extends the InputObjectType class, allowing it to be used as an input
 * object in GraphQL queries and mutations.
 */
class CartItemAttributeInputType extends InputObjectType
{
    private static ?self $instance = null;

    public function __construct()
    {
        parent::__construct([
            'name' => 'CartItemAttributeInput',
            'fields' => [
                'id' => Type::nonNull(Type::string()),
                'value' => Type::nonNull(Type::string())
            ]
        ]);
    }

    /**
     * Get an instance of the CartItemAttributeInputType.
     *
     * @return self An instance of the CartItemAttributeInputType.
     */
    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}
