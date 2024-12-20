<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "prices")]
class ProductPrice
{
  #[ORM\Id]
  #[ORM\Column(type: "integer")]
  #[ORM\GeneratedValue]
  private int $id;

  #[ORM\Column(type: "decimal", precision: 10, scale: 2)]
  private float $amount;

  #[ORM\ManyToOne(targetEntity: Product::class)]
  #[ORM\JoinColumn(name: "product_id", referencedColumnName: "id")]
  private Product $product;

  #[ORM\ManyToOne(targetEntity: ProductPriceCurrency::class)]
  #[ORM\JoinColumn(name: "currency_id", referencedColumnName: "id")]
  private ProductPriceCurrency $currency;

  public function getId(): int
  {
    return $this->id;
  }

  public function getAmount(): float
  {
    return $this->amount;
  }

  public function setAmount(float $amount)
  {
    $this->amount = $amount;
    return $this;
  }

  public function getCurrency(): ProductPriceCurrency
  {
    return $this->currency;
  }

  public function getProduct(): Product
  {
    return $this->product;
  }
}
