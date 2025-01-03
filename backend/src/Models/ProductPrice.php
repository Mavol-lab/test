<?php

namespace App\Models;

use App\Models\Abstract\ProductBase;
use Doctrine\ORM\Mapping as ORM;

/**
 * This class represents the price of a product in the system.
 * It is part of the Models namespace and is located in the backend/src/Models directory.
 */
#[ORM\Entity]
#[ORM\Table(name: "prices")]
class ProductPrice
{
    /**
     * @var int $id The unique identifier for the product price.
     */
    #[ORM\Id]
    #[ORM\Column(type: "integer")]
    #[ORM\GeneratedValue]
    private int $id;

    /**
     * @var float $amount The amount of the product price.
     */
    #[ORM\Column(type: "decimal", precision: 10, scale: 2)]
    private float $amount;

    /**
     * @var ProductBase $product The product associated with the price.
     */
    #[ORM\ManyToOne(targetEntity: ProductBase::class)]
    #[ORM\JoinColumn(name: "product_id", referencedColumnName: "id")]
    private ProductBase $product;

    /**
     * @var ProductPriceCurrency $currency The currency associated with the product price.
     */
    #[ORM\ManyToOne(targetEntity: ProductPriceCurrency::class)]
    #[ORM\JoinColumn(name: "currency_id", referencedColumnName: "id")]
    private ProductPriceCurrency $currency;

    public function __construct(float $amount, ProductBase $product, ProductPriceCurrency $currency)
    {
        $this->amount = $amount;
        $this->product = $product;
        $this->currency = $currency;
    }

    /**
     * Get the ID of the product price.
     *
     * @return int The ID of the product price.
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Get the amount of the product price.
     *
     * @return float The amount of the product price.
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * Set the amount for the product price.
     *
     * @param float $amount The amount to set.
     * @return self
     */
    public function setAmount(float $amount): self
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * Get the currency of the product price.
     *
     * @return ProductPriceCurrency The currency of the product price.
     */
    public function getCurrency(): ProductPriceCurrency
    {
        return $this->currency;
    }

    /**
     * Get the product associated with the price.
     *
     * @return ProductBase The product associated with the price.
     */
    public function getProduct(): ProductBase
    {
        return $this->product;
    }

    /**
     * Sets the product for the current instance.
     *
     * @param ProductBase $product The product to set.
     * @return self Returns the current instance for method chaining.
     */
    public function setProduct(ProductBase $product): self
    {
        $this->product = $product;

        return $this;
    }
}
