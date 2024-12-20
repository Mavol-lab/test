<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table('product_gallery')]
class ProductGallery
{
  #[ORM\Id]
  #[ORM\GeneratedValue(strategy: "AUTO")]
  #[ORM\Column(type: "integer")]
  private int $id;

  #[ORM\ManyToOne(targetEntity: 'Product', inversedBy: 'gallery')]
  #[ORM\JoinColumn(name: 'product_id', referencedColumnName: 'id')]
  private Product $product;

  #[ORM\Column(type: "text", name: 'image_url')]
  private string $imageUrl;

  public function getId(): int
  {
    return $this->id;
  }

  public function getImageUrl(): string
  {
    return $this->imageUrl;
  }

  public function setImageUrl(string $imageUrl): self
  {
    $this->imageUrl = $imageUrl;
    return $this;
  }

  public function getProduct(): Product
  {
    return $this->product;
  }

  public function setProduct(Product $product): self
  {
    $this->product = $product;
    return $this;
  }
}
