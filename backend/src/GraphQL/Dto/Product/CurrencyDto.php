<?php

namespace App\GraphQL\Dto\Product;

/**
 * Data Transfer Object (DTO) for representing currency information in the GraphQL API.
 */
final class CurrencyDto
{
    /**
     * @var int $id The unique identifier for the currency.
     */
    public int $id;

    /**
     * @var string The label of the currency.
     */
    public string $label;

    /**
     * @var string The symbol of the currency.
     */
    public string $symbol;

    /**
     * Default constructor.
     * Initializes the object without any specific initialization logic.
     * Required for automapper reflections.
     */
    public function __construct(
        int $id,
        string $label,
        string $symbol
    ) {
        $this->id = $id;
        $this->label = $label;
        $this->symbol = $symbol;
    }
}
