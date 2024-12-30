<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table('cart_item_attributes')]
class CartItemAttribute
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column(type: 'integer')]
  private int $id;

  #[ORM\Column(name: 'attribute_id', type: 'string')]
  private string $attributeId;

  #[ORM\Column(name: 'attribute_value', type: 'string')]
  private string $attributeValue;

  #[ORM\ManyToOne(targetEntity: 'CartItem', inversedBy: 'attributes')]
  #[ORM\JoinColumn(name: 'cart_item_id', referencedColumnName: 'id')]
  private CartItem $cartItem;

  public function __construct(CartItem $cartItem, string $attributeId, string $attributeValue)
  {
    $this->attributeId = $attributeId;
    $this->attributeValue = $attributeValue;
    $this->cartItem = $cartItem;
  }

  public function getId(): ?int
  {
    return $this->id;
  }

  public function getAttributeId(): ?string
  {
    return $this->attributeId;
  }

  public function setAttributeId(string $attributeId): self
  {
    $this->attributeId = $attributeId;

    return $this;
  }

  public function getAttributeValue(): ?string
  {
    return $this->attributeValue;
  }

  public function setAttributeValue(string $attributeValue): self
  {
    $this->attributeValue = $attributeValue;

    return $this;
  }

  public function getCartItem(): ?CartItem
  {
    return $this->cartItem;
  }

  public function setCartItem(CartItem $cartItem): self
  {
    $this->cartItem = $cartItem;

    return $this;
  }
}
