<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table('cart_items')]
class CartItem
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\ManyToOne(targetEntity: Cart::class, inversedBy: 'cartItems')]
    #[ORM\JoinColumn(name: 'cart_id', referencedColumnName: 'id')]
    private Cart $cart;

    #[ORM\Column(name: 'product_id', type: 'string')]
    private string $productId;

    #[ORM\Column(type: 'integer')]
    private int $quantity;

    #[ORM\OneToMany(targetEntity: CartItemAttribute::class, mappedBy: 'cartItem', cascade: ['persist'])]
    private Collection $attributes;

    public function __construct(Cart $cart, string $productId, int $quantity)
    {
        $this->cart = $cart;
        $this->productId = $productId;
        $this->quantity = $quantity;

        $this->attributes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductId(): ?string
    {
        return $this->productId;
    }

    public function setProductId(string $productId): self
    {
        $this->productId = $productId;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getCart(): ?Cart
    {
        return $this->cart;
    }

    public function setCart(Cart $cart): self
    {
        $this->cart = $cart;

        return $this;
    }

    public function getAttributes()
    {
        return $this->attributes;
    }

    public function addAttribute(CartItemAttribute $attribute): self
    {
        $this->attributes[] = $attribute;
        $attribute->setCartItem($this);

        return $this;
    }
}
