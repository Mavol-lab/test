<?php

namespace App\GraphQL\Input\Cart;

final class CartInput
{
    /**
     * @var CartItemInput[] $cartItems List of items in a cart.
     */
    public array $cartItems;

    /**
     * Default constructor.
     * Initializes the object without any specific initialization logic.
     * Required for automapper reflections.
     */
    public function __construct()
    {
        $this->cartItems = [];
    }
}
