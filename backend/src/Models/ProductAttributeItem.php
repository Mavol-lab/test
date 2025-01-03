<?php

namespace App\Models;

use Doctrine\ORM\Mapping as ORM;

/**
 * This class represents an item of a product attribute in the system.
 * It is used to manage and manipulate product attribute items.
 */
#[ORM\Entity]
#[ORM\Table(name: "attribute_items")]
class ProductAttributeItem
{
    /**
     * @var string $id The unique identifier for the product attribute item.
     */
    #[ORM\Id]
    #[ORM\Column(type: "string")]
    private string $id;

    /**
     * @var ProductAttribute $attribute The attribute associated with the product.
     */
    #[ORM\ManyToOne(targetEntity: ProductAttribute::class, inversedBy: "items")]
    #[ORM\JoinColumn(name: "attribute_id", referencedColumnName: "id")]
    private ProductAttribute $attribute;

    /**
     * @var string The display value of the product attribute item.
     */
    #[ORM\Column(type: "string", nullable: true)]
    private string $displayValue;

    /**
     * @var string The value of the product attribute item. It can be null.
     */
    #[ORM\Column(type: "string", nullable: true)]
    private string $value;

    public function __construct(
        string $id,
        ProductAttribute $attribute,
        string $displayValue,
        string $value
    ) {
        $this->id = $id;
        $this->attribute = $attribute;
        $this->displayValue = $displayValue;
        $this->value = $value;
    }

    /**
     * Get the ID of the product attribute item.
     *
     * @return string The ID of the product attribute item.
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Get the product attribute associated with this item.
     *
     * @return ProductAttribute The product attribute associated with this item.
     */
    public function getAttribute(): ProductAttribute
    {
        return $this->attribute;
    }

    /**
     * Sets the product attribute.
     *
     * @param ProductAttribute $attribute The product attribute to set.
     * @return self Returns the instance of the current object.
     */
    public function setAttribute(ProductAttribute $attribute): self
    {
        $this->attribute = $attribute;
        return $this;
    }

    /**
     * Get the display value of the product attribute item.
     *
     * @return string The display value.
     */
    public function getDisplayValue(): string
    {
        return $this->displayValue;
    }

    /**
     * Sets the display value for the product attribute item.
     *
     * @param string $displayValue The display value to set.
     * @return self Returns the instance of the ProductAttributeItem for method chaining.
     */
    public function setDisplayValue(string $displayValue): self
    {
        $this->displayValue = $displayValue;
        return $this;
    }

    /**
     * Get the value of the product attribute item.
     *
     * @return string The value of the product attribute item.
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * Set the value of the product attribute item.
     *
     * @param string $value The value to set.
     * @return self Returns the instance of the ProductAttributeItem.
     */
    public function setValue(string $value): self
    {
        $this->value = $value;
        return $this;
    }
}
