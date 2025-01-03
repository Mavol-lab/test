<?php

namespace App\GraphQL\Input\Product;

/**
 * This class represents the input for a product attribute item in the GraphQL API.
 * It is used to encapsulate the data required for creating or updating a product attribute item.
 */
final class ProductAttributeItemInput
{
    /**
     * @var string $displayValue The display value of the product attribute item.
     */
    public string $displayValue;

    /**
     * @var string $value The value of the product attribute item.
     */
    public string $value;

    /**
     * Default constructor.
     * Initializes the object without any specific initialization logic.
     * Required for automapper reflections.
     */
    public function __construct(string $displayValue = '', string $value = '')
    {
        $this->displayValue = $displayValue;
        $this->value = $value;
    }
}
