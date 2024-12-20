<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "attribute_items")]
class ProductAttributeItem
{
  #[ORM\Id]
  #[ORM\Column(type: "string")]
  private string $id;

  #[ORM\ManyToOne(targetEntity: ProductAttribute::class, inversedBy: "items")]
  #[ORM\JoinColumn(name: "attribute_id", referencedColumnName: "id")]
  private ProductAttribute $attribute;

  #[ORM\Column(type: "string", nullable: true)]
  private ?string $displayValue = null;

  #[ORM\Column(type: "string", nullable: true)]
  private ?string $value = null;

  public function getId(): string
  {
    return $this->id;
  }

  public function getAttribute(): ProductAttribute
  {
    return $this->attribute;
  }

  public function setAttribute(string $attribute): self
  {
    $this->attribute = $attribute;
    return $this;
  }

  public function getDisplayValue(): string
  {
    return $this->displayValue;
  }

  public function setDisplayValue(string $displayValue): self
  {
    $this->displayValue = $displayValue;
    return $this;
  }

  public function getValue(): string
  {
    return $this->value;
  }

  public function setValue(string $value): self
  {
    $this->value = $value;
    return $this;
  }
}
