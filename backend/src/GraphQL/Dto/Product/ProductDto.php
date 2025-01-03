<?php

namespace App\GraphQL\Dto\Product;

/**
 * Data Transfer Object (DTO) for Product.
 */
final class ProductDto
{
    /**
     * @var string|null The unique identifier for the product.
     */
    public ?string $id;

    /**
     * @var string $name The name of the product.
     */
    public string $name;

    /**
     * @var bool $inStock Indicates whether the product is in stock.
     */
    public bool $inStock;

    /**
     * @var string $description The description of the product.
     */
    public string $description;

    /**
     * @var string $brand The brand of the product.
     */
    public string $brand;

    /**
     * @var GalleryDto[] $gallery An array containing the gallery images for the product.
     */
    public array $gallery;

    /**
     * @var PriceDto[] $prices An array containing the prices of the product.
     */
    public array $prices;

    /**
     * @var AttributeDto[] $attributes An array of attributes for the product.
     */
    public array $attributes;

    /**
     * @var CategoryDto The category associated with the product.
     */
    public CategoryDto $category;

    /**
     * Default constructor.
     * Initializes the object without any specific initialization logic.
     * Required for automapper reflections.
     * 
     * @param GalleryDto[] $gallery
     * @param PriceDto[] $prices
     * @param AttributeDto[] $attributes
     */
    public function __construct(
        ?string $id,
        string $name,
        bool $inStock,
        string $description,
        string $brand,
        array $gallery,
        array $prices,
        array $attributes,
        CategoryDto $category
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->inStock = $inStock;
        $this->description = $description;
        $this->brand = $brand;
        $this->gallery = $gallery;
        $this->prices = $prices;
        $this->attributes = $attributes;
        $this->category = $category;
    }
}
