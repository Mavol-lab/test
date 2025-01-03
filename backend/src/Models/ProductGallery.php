<?php

namespace App\Models;

use App\Models\Abstract\ProductBase;
use Doctrine\ORM\Mapping as ORM;

/**
 * This class represents the gallery of products in the application.
 * It is used to manage and display product images.
 */
#[ORM\Entity]
#[ORM\Table('product_gallery')]
class ProductGallery
{
    /**
     * @var int $id The unique identifier for the product gallery.
     */
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    #[ORM\Column(type: "integer")]
    private int $id;

    /**
     * @var ProductBase $product An instance of the ProductBase class representing the product associated with the gallery.
     */
    #[ORM\ManyToOne(targetEntity: ProductBase::class, inversedBy: 'gallery')]
    #[ORM\JoinColumn(name: 'product_id', referencedColumnName: 'id')]
    private ProductBase $product;

    /**
     * @var string $imageUrl The URL of the product image.
     */
    #[ORM\Column(type: "text", name: 'image_url')]
    private string $imageUrl;

    public function __construct(
        ProductBase $product,
        string $imageUrl
    ) {
        $this->product = $product;
        $this->imageUrl = $imageUrl;
    }

    /**
     * Get the ID of the product gallery.
     *
     * @return int The ID of the product gallery.
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Get the URL of the product image.
     *
     * @return string The URL of the product image.
     */
    public function getImageUrl(): string
    {
        return $this->imageUrl;
    }

    /**
     * Set the image URL for the product gallery.
     *
     * @param string $imageUrl The URL of the image to be set.
     * @return self Returns the instance of the ProductGallery for method chaining.
     */
    public function setImageUrl(string $imageUrl): self
    {
        $this->imageUrl = $imageUrl;
        return $this;
    }

    /**
     * Get the product associated with the gallery.
     *
     * @return ProductBase The product associated with the gallery.
     */
    public function getProduct(): ProductBase
    {
        return $this->product;
    }

    /**
     * Sets the product for the product gallery.
     *
     * @param ProductBase $product The product to be set.
     * @return self Returns the instance of the ProductGallery.
     */
    public function setProduct(ProductBase $product): self
    {
        $this->product = $product;
        return $this;
    }
}
