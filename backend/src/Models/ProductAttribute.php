<?php

namespace App\Models;

use App\Models\Abstract\ProductBase;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * This class represents a product attribute in the system.
 * It is used to define and manage attributes associated with products.
 */
#[ORM\Entity]
#[ORM\Table(name: "attributes")]
class ProductAttribute
{
    /**
     * @var string $id The unique identifier for the product attribute.
     */
    #[ORM\Id]
    #[ORM\Column(type: "string")]
    private string $id;

    /**
     * @var ProductBase $product The product associated with this attribute.
     */
    #[ORM\ManyToOne(targetEntity: ProductBase::class, inversedBy: "attributes")]
    #[ORM\JoinColumn(name: "product_id", referencedColumnName: "id")]
    private ProductBase $product;

    /**
     * @var string $name The name of the product attribute.
     */
    #[ORM\Column(type: "string")]
    private string $name;

    /**
     * @var string $type The type of the product attribute.
     */
    #[ORM\Column(type: "string")]
    private string $type;

    /**
     * @var ArrayCollection<int, ProductAttributeItem> $items A collection of items associated with the product attribute.
     */
    #[ORM\OneToMany(targetEntity: ProductAttributeItem::class, mappedBy: "attribute", cascade: ["persist"])]
    private Collection $items;

    public function __construct()
    {
        $this->items = new ArrayCollection();
    }

    /**
     * Get the ID of the product attribute.
     *
     * @return string The ID of the product attribute.
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Get the product associated with this attribute.
     *
     * @return ProductBase The product associated with this attribute.
     */
    public function getProduct(): ProductBase
    {
        return $this->product;
    }

    /**
     * Set the product associated with this attribute.
     *
     * @param ProductBase $product The product to set.
     * @return self Returns the instance of the ProductAttribute for method chaining.
     */
    public function setProduct(ProductBase $product): self
    {
        $this->product = $product;
        return $this;
    }

    /**
     * Get the name of the product attribute.
     *
     * @return string The name of the product attribute.
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the name of the product attribute.
     *
     * @param string $name The name to set.
     * @return self Returns the instance of the ProductAttribute for method chaining.
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the type of the product attribute.
     *
     * @return string The type of the product attribute.
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Set the type of the product attribute.
     *
     * @param string $type The type to set.
     * @return self Returns the instance of the ProductAttribute for method chaining.
     */
    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Retrieve a collection of items.
     *
     * @return Collection
     */
    public function getItems(): Collection
    {
        return $this->items;
    }
}
