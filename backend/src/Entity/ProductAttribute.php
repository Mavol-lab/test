<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity]
#[ORM\Table(name: "attributes")]
class ProductAttribute
{
  #[ORM\Id]
  #[ORM\Column(type: "string")]
  private string $id;

  #[ORM\ManyToOne(targetEntity: Product::class, inversedBy: "attributes")]
  #[ORM\JoinColumn(name: "product_id", referencedColumnName: "id")]
  private Product $product;

  #[ORM\Column(type: "string")]
  private string $name;

  #[ORM\Column(type: "string")]
  private string $type;

  #[ORM\OneToMany(targetEntity: ProductAttributeItem::class, mappedBy: "attribute", cascade: ["persist"])]
  private Collection $items;

  public function __construct()
  {
    $this->items = new ArrayCollection();
  }

  public function getId(): string
  {
    return $this->id;
  }

  public function getProduct(): Product
  {
    return $this->product;
  }

  public function setProduct(string $product): self
  {
    $this->product = $product;
    return $this;
  }

  public function getName(): string
  {
    return $this->name;
  }

  public function setName(string $name): self
  {
    $this->name = $name;
    return $this;
  }

  public function getType(): string
  {
    return $this->type;
  }

  public function setType(string $type): self
  {
    $this->type = $type;
    return $this;
  }

  public function getItems(): Collection
  {
    return $this->items;
  }
}
