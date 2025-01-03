<?php

namespace App\GraphQL\Dto\Product;

/**
 * Data Transfer Object (DTO) for representing a product category in GraphQL.
 */
final class CategoryDto
{
    /**
     * @var int $id The unique identifier for the category.
     */
    public int $id;

    /**
     * @var string The name of the product category.
     */
    public string $name;

    /**
     * Default constructor.
     * Initializes the object without any specific initialization logic.
     * Required for automapper reflections.
     */
    public function __construct(
        int $id,
        string $name
    ) {
        $this->id = $id;
        $this->name = $name;
    }
}
