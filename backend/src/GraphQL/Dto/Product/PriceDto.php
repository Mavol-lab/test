<?php

namespace App\GraphQL\Dto\Product;

/**
 * Data Transfer Object (DTO) for representing the price of a product.
 */
final class PriceDto
{
    /**
     * @var int $id The unique identifier for the product price.
     */
    public int $id;

    /**
     * @var float $amount The amount of the product price.
     */
    public float $amount;

    /**
     * @var CurrencyDto The currency details associated with the product price.
     */
    public CurrencyDto $currency;

    /**
     * Default constructor.
     * Initializes the object without any specific initialization logic.
     * Required for automapper reflections.
     */
    public function __construct(
        int $id,
        float $amount,
        CurrencyDto $currency
    ) {
        $this->id = $id;
        $this->amount = $amount;
        $this->currency = $currency;
    }
}
