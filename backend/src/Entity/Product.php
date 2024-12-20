<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: 'App\Repository\ProductRepository')]
#[ORM\Table('products')]
class Product
{
  #[ORM\Id]
  #[ORM\GeneratedValue(strategy: "AUTO")]
  #[ORM\Column(type: "string")]
  private string $id;

  #[ORM\Column(type: "string",)]
  private string $name;

  #[ORM\Column(type: "boolean")]
  private bool $inStock;

  #[ORM\Column(type: "string")]
  private string $description;

  #[ORM\Column(type: "string")]
  private string $brand;

  #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'products')]
  #[ORM\JoinColumn(name: 'category_id', referencedColumnName: 'id')]
  private Category $category;

  #[ORM\OneToMany(targetEntity: ProductGallery::class, mappedBy: 'product')]
  private Collection $gallery;

  #[ORM\OneToMany(targetEntity: ProductPrice::class, mappedBy: 'product')]
  private Collection $prices;

  #[ORM\OneToMany(targetEntity: ProductAttribute::class, mappedBy: 'product')]
  private Collection $attributes;

  public function __construct()
  {
    $this->gallery = new ArrayCollection();
    $this->prices = new ArrayCollection();
    $this->attributes = new ArrayCollection();
  }

  public function getGallery(): Collection
  {
    return $this->gallery;
  }

  public function getPrices(): Collection
  {
    return $this->prices;
  }

  public function getAttributes(): Collection
  {
    return $this->attributes;
  }

  public function getCategory(): Category
  {
    return $this->category;
  }


  public function getId(): string
  {
    return $this->id;
  }

  public function setId(string $id): void
  {
    $this->id = $id;
  }

  public function getName(): string
  {
    return $this->name;
  }

  public function setName(string $name): void
  {
    $this->name = $name;
  }

  public function getInStock(): bool
  {
    return $this->inStock;
  }

  public function setInStock(bool $inStock): void
  {
    $this->inStock = $inStock;
  }

  public function getDescription(): string
  {
    return $this->description;
  }

  public function setDescription(string $description): void
  {
    $this->description = $description;
  }

  public function getBrand(): string
  {
    return $this->brand;
  }

  public function setBrand(string $brand): void
  {
    $this->brand = $brand;
  }
}
