<?php

namespace App\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: 'App\Repository\CartRepository')]
#[ORM\Table('carts')]
class Cart
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\OneToMany(targetEntity: CartItem::class, mappedBy: 'cart', cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $cartItems;

    #[ORM\Column(name: 'created_at', type: 'datetime')]
    private DateTime $createdAt;

    public function __construct()
    {
        $this->createdAt = new DateTime();
        $this->cartItems = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function getCartItems()
    {
        return $this->cartItems;
    }

    public function addCartItem(CartItem $cartItem): self
    {
        $this->cartItems[] = $cartItem;

        return $this;
    }
}
