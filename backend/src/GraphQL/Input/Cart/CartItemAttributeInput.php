<?php

namespace App\GraphQL\Input\Cart;

final class CartItemAttributeInput
{
    /**
     * @var string $name Attribute unique identifier.
     */
    public string $id;

    /**
     * @var string $value Selected attribute value.
     */
    public string $value;

    /**
     * Default constructor.
     * Initializes the object without any specific initialization logic.
     * Required for automapper reflections.
     */
    public function __construct(string $id = '', string $value = '')
    {
        $this->id = $id;
        $this->value = $value;
    }
}
