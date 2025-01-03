<?php

namespace App\Models;

use App\Utils\ExceptionCode;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Represents an item in a shopping cart.
 */
#[ORM\Entity]
#[ORM\Table('cart_items')]
class CartItem
{
    /**
     * @var string
     * 
     * Constant representing the column name for the cart ID in the database.
     */
    private const COLUMN_CART_ID = 'cart_id';

    /**
     * @var string
     * 
     * The name of the column that stores the product ID in the cart items table.
     */
    private const COLUMN_PRODUCT_ID = 'product_id';

    /**
     * @var int|null The unique identifier for the cart item. It can be null if the item is not yet persisted.
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    /**
     * @var Cart $cart The cart associated with this cart item.
     */
    #[ORM\ManyToOne(targetEntity: Cart::class, inversedBy: 'cartItems')]
    #[ORM\JoinColumn(name: self::COLUMN_CART_ID, referencedColumnName: 'id')]
    private Cart $cart;

    /**
     * @var string $productId The unique identifier for the product in the cart item.
     */
    #[ORM\Column(name: self::COLUMN_PRODUCT_ID, type: 'string')]
    private string $productId;

    /**
     * @var int $quantity The quantity of the cart item.
     */
    #[ORM\Column(type: 'integer')]
    private int $quantity;

    /**
     * @var ArrayCollection<int, CartItemAttribute> $attributes A collection of attributes associated with the cart item.
     */
    #[ORM\OneToMany(targetEntity: CartItemAttribute::class, mappedBy: 'cartItem', cascade: ['persist'])]
    private Collection $attributes;

    public function __construct(Cart $cart, string $productId, int $quantity)
    {
        $this->cart = $cart;
        $this->productId = $productId;
        $this->quantity = $quantity;
        $this->attributes = new ArrayCollection();
    }

    /**
     * Get the ID of the cart item.
     *
     * @return int|null The ID of the cart item, or null if not set.
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get the product ID.
     *
     * @return string|null The product ID or null if not set.
     */
    public function getProductId(): ?string
    {
        return $this->productId;
    }

    /**
     * Set the product ID for the cart item.
     *
     * @param string $productId The ID of the product to set.
     * @return self Returns the instance of the CartItem for method chaining.
     */
    public function setProductId(string $productId): self
    {
        $this->productId = $productId;

        return $this;
    }

    /**
     * Get the quantity of the cart item.
     *
     * @return int|null The quantity of the cart item, or null if not set.
     */
    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    /**
     * Set the quantity of the cart item.
     *
     * @param int $quantity The quantity to set.
     * @return self Returns the instance of the CartItem.
     */
    public function setQuantity(int $quantity): self
    {
        if ($quantity <= 0) {
            throw new ExceptionCode(400, 'Quantity must be greater than zero.');
        }

        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get the cart associated with the cart item.
     *
     * @return Cart|null The cart associated with the cart item, or null if no cart is associated.
     */
    public function getCart(): ?Cart
    {
        return $this->cart;
    }

    /**
     * Sets the cart for the cart item.
     *
     * @param Cart $cart The cart to associate with the cart item.
     * @return self Returns the instance of the cart item.
     */
    public function setCart(Cart $cart): self
    {
        $this->cart = $cart;

        return $this;
    }

    /**
     * Get the attributes of the cart item.
     *
     * @return ArrayCollection<int, CartItemAttribute> The collection of attributes.
     */
    public function getAttributes(): ArrayCollection
    {
        return $this->attributes;
    }

    /**
     * Adds an attribute to the cart item.
     *
     * @param CartItemAttribute $attribute The attribute to add.
     * @return self Returns the instance of the cart item with the added attribute.
     */
    public function addAttribute(CartItemAttribute $attribute): self
    {
        if (!$this->attributes->contains($attribute)) {
            $this->attributes[] = $attribute;
            $attribute->setCartItem($this);
        }

        return $this;
    }
}
