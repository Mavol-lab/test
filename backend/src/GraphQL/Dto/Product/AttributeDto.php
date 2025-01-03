<?php

namespace App\GraphQL\Dto\Product;

/**
 * This class represents a Data Transfer Object (DTO) for product attributes in the GraphQL API.
 * It is used to transfer data between different layers of the application.
 */
final class AttributeDto
{
    /**
     * @var string $id The unique identifier for the product attribute.
     */
    public string $id;

    /**
     * The name of the product attribute.
     *
     * @var string
     */
    public string $name;

    /**
     * @var string The type of the product attribute.
     */
    public string $type;

    /**
     * @var AttributeItemDto[] $items
     */
    public array $items;

    /**
     * Default constructor.
     * Initializes the object without any specific initialization logic.
     * Required for automapper reflections.
     * 
     * @param AttributeItemDto[] $items
     */
    public function __construct(
        string $id,
        string $name,
        string $type,
        array $items
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->type = $type;
        $this->items = $items;
    }
}
