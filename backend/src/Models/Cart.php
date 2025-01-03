<?php

namespace App\Models;

use App\Repository\CartRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class representing a shopping cart entity.
 * It contains the cart's items and tracks its creation date.
 */
#[ORM\Entity(repositoryClass: CartRepository::class)]
#[ORM\Table('carts')]
class Cart
{
    /**
     * The unique identifier of the cart.
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    /**
     * The collection of cart items associated with this cart.
     */
    #[ORM\OneToMany(targetEntity: CartItem::class, mappedBy: 'cart', cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $cartItems;

    /**
     * The date and time when the cart was created.
     */
    #[ORM\Column(name: 'created_at', type: 'datetime')]
    private DateTime $createdAt;

    /**
     * Cart constructor.
     * Initializes the created_at field with the current date and time and creates an empty cartItems collection.
     */
    public function __construct()
    {
        $this->createdAt = new DateTime();
        $this->cartItems = new ArrayCollection();
    }

    /**
     * Gets the ID of the cart.
     * 
     * @return int|null The cart's unique identifier.
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Gets the creation date and time of the cart.
     * 
     * @return DateTime The date and time when the cart was created.
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * Gets the collection of cart items in the cart.
     * 
     * @return Collection The collection of cart items.
     */
    public function getCartItems()
    {
        return $this->cartItems;
    }

    /**
     * Adds a new cart item to the cart.
     * 
     * @param CartItem $cartItem The cart item to add.
     * @return self Returns the current instance for method chaining.
     */
    public function addCartItem(CartItem $cartItem): self
    {
        $this->cartItems[] = $cartItem;

        return $this;
    }
}
