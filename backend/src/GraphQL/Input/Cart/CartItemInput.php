<?php

namespace App\GraphQL\Input\Cart;

final class CartItemInput
{
    /**
     * @var string $productId The unique identifier of the product to be added to the cart.
     */
    public string $productId;

    /**
     * @var int $quantity The quantity of the cart item.
     */
    public int $quantity;

    /**
     * @var CartItemAttributeInput[] $attributes An array of attributes for the cart item input.
     */
    public array $attributes;

    /**
     * Default constructor.
     * Initializes the object without any specific initialization logic.
     * Required for automapper reflections.
     */
    public function __construct(string $productId, int $quantity, array $attributes = [])
    {
        $this->productId = $productId;
        $this->quantity = $quantity;
        $this->attributes = $attributes;
    }
}
