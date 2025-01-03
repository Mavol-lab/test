<?php

namespace App\GraphQL\Type\Cart;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\InputObjectType;

/**
 * This class represents the input type for a cart item in GraphQL.
 * It extends the InputObjectType class to define the structure of the input
 * for cart items, which can be used in GraphQL mutations or queries.
 */
class CartItemInputType extends InputObjectType
{
    private static ?self $instance = null;

    public function __construct()
    {
        parent::__construct([
            'name' => 'CartItemInput',
            'fields' => [
                'productId' => Type::nonNull(Type::string()),
                'quantity' => Type::nonNull(Type::int()),
                'attributes' => Type::listOf(CartItemAttributeInputType::getInstance())
            ]
        ]);
    }

    /**
     * Get an instance of the CartItemInputType.
     *
     * @return self An instance of the CartItemInputType.
     */
    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}
