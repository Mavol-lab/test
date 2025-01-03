<?php

namespace App\GraphQL\Input\Product;

/**
 * This class represents the input data structure for a product in the GraphQL API.
 * It is used to define the fields and types of data that can be provided when creating or updating a product.
 */
final class ProductInput
{
    /**
     * @var string $name The name of the product.
     */
    public string $name;

    /**
     * Indicates whether the product is in stock.
     *
     * @var bool
     */
    public bool $inStock;

    /**
     * @var string $description A brief description of the product.
     */
    public string $description;

    /**
     * @var string $brand The brand of the product.
     */
    public string $brand;

    /**
     * @var ProductGalleryInput[] $gallery An array representing the gallery of the product.
     */
    public array $gallery;

    /**
     * @var string $categoryId The ID of the category to which the product belongs.
     */
    public string $categoryId;

    /**
     * @var ProductPriceInput[] $prices An array of prices associated with the product.
     */
    public array $prices;

    /**
     * @var array $attributes An array of attributes for the product input.
     */
    public array $attributes;

    /**
     * Default constructor.
     * Initializes the object without any specific initialization logic.
     * Required for automapper reflections.
     */
    public function __construct(string $name = '', bool $inStock = false, string $description = '', string $brand = '', array $gallery = [], string $categoryId = '', array $prices = [], array $attributes = [])
    {
        $this->name = $name;
        $this->inStock = $inStock;
        $this->description = $description;
        $this->brand = $brand;
        $this->gallery = $gallery;
        $this->categoryId = $categoryId;
        $this->prices = $prices;
        $this->attributes = $attributes;
    }
}
