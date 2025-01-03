<?php

namespace App\GraphQL\Input\Product;

/**
 * This class represents the input structure for product price in GraphQL.
 * It is used to handle and validate the price-related data for products.
 */
final class ProductPriceInput
{
    /**
     * @var float $amount The amount of the product price.
     */
    public float $amount;

    /**
     * @var string $currencyId The ID of the currency associated with the product price.
     */
    public string $currencyId;

    /**
     * Default constructor.
     * Initializes the object without any specific initialization logic.
     * Required for automapper reflections.
     */
    public function __construct(float $amount = 0.0, string $currencyId = '')
    {
        $this->amount = $amount;
        $this->currencyId = $currencyId;
    }
}
