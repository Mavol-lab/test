<?php

namespace App\GraphQL\Input\Product;

/**
 * This class represents the input structure for a product gallery in the GraphQL API.
 * It is used to handle the input data for product gallery operations.
 */
final class ProductGalleryInput
{
    /**
     * @var string $imageUrl The URL of the product image.
     */
    public string $imageUrl;

    /**
     * Default constructor.
     * Initializes the object without any specific initialization logic.
     * Required for automapper reflections.
     */
    public function __construct(string $imageUrl)
    {
        $this->imageUrl = $imageUrl;
    }
}
