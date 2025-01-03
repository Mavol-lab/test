<?php

namespace App\GraphQL\Dto\Product;

/**
 * This class represents a Data Transfer Object (DTO) for a product attribute item.
 * It is used to transfer data between different layers of the application.
 */
final class AttributeItemDto
{
    /**
     * @var string The unique identifier for the attribute item.
     */
    public string $id;

    /**
     * @var string The display value of the attribute item.
     */
    public string $displayValue;

    /**
     * @var string The value of the attribute item.
     */
    public string $value;

    /**
     * Default constructor.
     * Initializes the object without any specific initialization logic.
     * Required for automapper reflections.
     */
    public function __construct(
        string $id,
        string $displayValue,
        string $value
    ) {
        $this->id = $id;
        $this->displayValue = $displayValue;
        $this->value = $value;
    }
}
