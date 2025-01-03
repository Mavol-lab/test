<?php

namespace App\GraphQL\Dto\Product;

/**
 * Data Transfer Object (DTO) for representing a product gallery.
 */
final class GalleryDto
{
    /**
     * @var int $id The unique identifier for the product gallery.
     */
    public int $id;

    /**
     * @var string The URL of the product image.
     */
    public string $imageUrl;

    /**
     * Default constructor.
     * Initializes the object without any specific initialization logic.
     * Required for automapper reflections.
     * 
     */
    public function __construct(
        int $id,
        string $imageUrl
    ) {
        $this->id = $id;
        $this->imageUrl = $imageUrl;
    }
}
