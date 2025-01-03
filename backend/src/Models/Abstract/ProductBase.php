<?php

namespace App\Models\Abstract;

use App\Models\Category;
use App\Models\ProductAttribute;
use App\Models\ProductGallery;
use App\Models\ProductPrice;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\MappedSuperclass]
abstract class ProductBase
{
    /**
     * @var string|null The unique identifier for the product. It can be null if the product is not yet persisted.
     */
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    #[ORM\Column(type: "string")]
    private ?string $id = null;

    /**
     * @var string $name The name of the product.
     */
    #[ORM\Column(type: "string",)]
    private string $name;

    /**
     * Indicates whether the product is in stock.
     *
     * @var bool
     */
    #[ORM\Column(type: "boolean")]
    private bool $inStock;

    /**
     * @var string $description The description of the product.
     */
    #[ORM\Column(type: "string")]
    private string $description;

    /**
     * @var string $brand The brand of the product.
     */
    #[ORM\Column(type: "string")]
    private string $brand;

    /**
     * @var Category $category The category associated with the product.
     */
    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'products')]
    #[ORM\JoinColumn(name: 'category_id', referencedColumnName: 'id')]
    private Category $category;

    /**
     * @var ArrayCollection<int, ProductGallery> $gallery A collection of gallery items associated with the product.
     */
    #[ORM\OneToMany(targetEntity: ProductGallery::class, mappedBy: 'product')]

    private Collection $gallery;

    /**
     * @var ArrayCollection<int, ProductPrice> $prices A collection of price objects associated with the product.
     */
    #[ORM\OneToMany(targetEntity: ProductPrice::class, mappedBy: 'product')]
    private Collection $prices;

    /**
     * @var ArrayCollection<int, ProductAttribute> $attributes A collection of attributes associated with the product.
     */
    #[ORM\OneToMany(targetEntity: ProductAttribute::class, mappedBy: 'product')]
    private Collection $attributes;

    /**
     * Constructor for the ProductBase class.
     *
     * Initializes a new instance of the ProductBase class.
     */
    public function __construct(
        string $name,
        bool $inStock,
        string $description,
        string $brand,
        Category $category
    ) {
        $this->name = $name;
        $this->inStock = $inStock;
        $this->description = $description;
        $this->brand = $brand;
        $this->category = $category;
        $this->gallery = new ArrayCollection();
        $this->prices = new ArrayCollection();
        $this->attributes = new ArrayCollection();
    }

    /**
     * Get the ID of the product.
     *
     * @return string|null The ID of the product, or null if not set.
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * Get the name of the product.
     *
     * @return string The name of the product.
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the name of the product.
     *
     * @param string $name The name of the product.
     * @return self Returns the instance of the product.
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Check if the product is in stock.
     *
     * @return bool True if the product is in stock, false otherwise.
     */
    public function getInStock(): bool
    {
        return $this->inStock;
    }

    /**
     * Sets the in-stock status of the product.
     *
     * @param bool $inStock The in-stock status to set.
     * @return self Returns the instance of the product.
     */
    public function setInStock(bool $inStock): self
    {
        $this->inStock = $inStock;

        return $this;
    }

    /**
     * Get the description of the product.
     *
     * @return string The description of the product.
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Set the description of the product.
     *
     * @param string $description The description of the product.
     * @return self Returns the instance of the product.
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the brand of the product.
     *
     * @return string The brand of the product.
     */
    public function getBrand(): string
    {
        return $this->brand;
    }

    /**
     * Set the brand for the product.
     *
     * @param string $brand The brand name to set.
     * @return self Returns the instance of the product.
     */
    public function setBrand(string $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get the category of the product.
     *
     * @return Category The category of the product.
     */
    public function getCategory(): Category
    {
        return $this->category;
    }

    /**
     * Sets the category for the product.
     *
     * @param Category $category The category to set.
     * @return self Returns the instance of the product.
     */
    public function setCategory(Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get the gallery collection.
     *
     * @return Collection The collection of gallery items.
     */
    public function getGallery(): Collection
    {
        return $this->gallery;
    }

    /**
     * Adds a gallery item to the product.
     *
     * @param ProductGallery $item The gallery item to add.
     * @return void
     */
    public function addGalleryItem(ProductGallery $item): void
    {
        if (!$this->gallery->contains($item)) {
            $this->gallery->add($item);
            $item->setProduct($this);
        }
    }

    /**
     * Removes a gallery item from the product.
     *
     * @param ProductGallery $item The gallery item to be removed.
     *
     * @return void
     */
    public function removeGalleryItem(ProductGallery $item): void
    {
        if ($this->gallery->contains($item)) {
            $this->gallery->removeElement($item);
        }
    }

    /**
     * Retrieve the collection of prices.
     *
     * @return Collection The collection of prices.
     */
    public function getPrices(): Collection
    {
        return $this->prices;
    }

    /**
     * Adds a price to the product.
     *
     * @param ProductPrice $price The price to be added.
     *
     * @return void
     */
    public function addPrice(ProductPrice $price): void
    {
        if (!$this->prices->contains($price)) {
            $this->prices->add($price);
            $price->setProduct($this);
        }
    }

    /**
     * Removes the specified price from the product.
     *
     * @param ProductPrice $price The price to be removed.
     *
     * @return void
     */
    public function removePrice(ProductPrice $price): void
    {
        if ($this->prices->contains($price)) {
            $this->prices->removeElement($price);
        }
    }

    /**
     * Get the attributes of the product.
     *
     * @return Collection The collection of product attributes.
     */
    public function getAttributes(): Collection
    {
        return $this->attributes;
    }

    /**
     * Adds a product attribute to the product.
     *
     * @param ProductAttribute $attribute The attribute to be added.
     *
     * @return void
     */
    public function addAttribute(ProductAttribute $attribute): void
    {
        if (!$this->attributes->contains($attribute)) {
            $this->attributes->add($attribute);
            $attribute->setProduct($this);
        }
    }

    /**
     * Removes the specified attribute from the product.
     *
     * @param ProductAttribute $attribute The attribute to be removed.
     *
     * @return void
     */
    public function removeAttribute(ProductAttribute $attribute): void
    {
        if ($this->attributes->contains($attribute)) {
            $this->attributes->removeElement($attribute);
        }
    }
}
