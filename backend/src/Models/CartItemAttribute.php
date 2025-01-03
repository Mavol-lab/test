<?php

namespace App\Models;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table('cart_item_attributes')]
class CartItemAttribute
{
    /**
     * @var int $id The unique identifier for the cart item attribute.
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    /**
     * @var string $attributeId The unique identifier for the attribute associated with the cart item.
     */
    #[ORM\Column(name: 'attribute_id', type: 'string')]
    private string $attributeId;

    /**
     * @var string The value of the cart item attribute.
     */
    #[ORM\Column(name: 'attribute_value', type: 'string')]
    private string $attributeValue;

    /**
     * @var CartItem $cartItem The cart item associated with this attribute.
     */
    #[ORM\ManyToOne(targetEntity: CartItem::class, inversedBy: 'attributes')]
    #[ORM\JoinColumn(name: 'cart_item_id', referencedColumnName: 'id')]
    private CartItem $cartItem;

    /**
     * @param CartItem $cartItem The cart item associated with this attribute.
     * @param string $attributeId The ID of the attribute.
     * @param string $attributeValue The value of the attribute.
     */
    public function __construct(CartItem $cartItem, string $attributeId, string $attributeValue)
    {
        $this->attributeId = $attributeId;
        $this->attributeValue = $attributeValue;
        $this->cartItem = $cartItem;
    }

    /**
     * Get the ID of the cart item attribute.
     *
     * @return int|null The ID of the cart item attribute, or null if not set.
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get the attribute ID.
     *
     * @return string|null The attribute ID or null if not set.
     */
    public function getAttributeId(): ?string
    {
        return $this->attributeId;
    }

    /**
     * Set the attribute ID for the cart item attribute.
     *
     * @param string $attributeId The ID of the attribute to set.
     * @return self Returns the instance of the CartItemAttribute for method chaining.
     */
    public function setAttributeId(string $attributeId): self
    {
        $this->attributeId = $attributeId;

        return $this;
    }

    /**
     * Get the value of the attribute.
     *
     * @return string|null The value of the attribute, or null if not set.
     */
    public function getAttributeValue(): ?string
    {
        return $this->attributeValue;
    }

    /**
     * Set the value of the attribute.
     *
     * @param string $attributeValue The value to set for the attribute.
     * @return self Returns the instance of the CartItemAttribute for method chaining.
     */
    public function setAttributeValue(string $attributeValue): self
    {
        $this->attributeValue = $attributeValue;

        return $this;
    }

    /**
     * Get the CartItem associated with this CartItemAttribute.
     *
     * @return CartItem|null The CartItem object or null if not set.
     */
    public function getCartItem(): ?CartItem
    {
        return $this->cartItem;
    }

    /**
     * Sets the CartItem for this CartItemAttribute.
     *
     * @param CartItem $cartItem The CartItem instance to associate with this attribute.
     * @return self Returns the current instance for method chaining.
     */
    public function setCartItem(CartItem $cartItem): self
    {
        $this->cartItem = $cartItem;

        return $this;
    }
}
