<?php

namespace App\GraphQL\Input\Product;

/**
 * This class represents the input data structure for product attributes in GraphQL.
 * It is used to define the attributes of a product that can be queried or mutated
 * through the GraphQL API.
 */
final class ProductAttributeInput
{
    /**
     * @var string $name The name of the product attribute.
     */
    public string $name;

    /**
     * @var string $type The type of the product attribute.
     */
    public string $type;

    /**
     * @var ProductAttributeItemInput[] $items An array of product attributes.
     */
    public array $items;

    /**
     * Default constructor.
     * Initializes the object without any specific initialization logic.
     * Required for automapper reflections.
     */
    public function __construct(string $name = '', string $type = '', array $items = [])
    {
        $this->name = $name;
        $this->type = $type;
        $this->items = $items;
    }
}
