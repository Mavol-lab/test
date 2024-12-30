<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: 'App\Repository\CategoryRepository')]
#[ORM\Table('categories')]
class Category
{
  #[ORM\Id]
  #[ORM\GeneratedValue('AUTO')]
  #[ORM\Column(type: 'integer')]
  private int $id;

  #[ORM\Column(type: 'string', length: 255)]
  private string $name;

  #[ORM\OneToMany(mappedBy: 'category', targetEntity: Product::class)]
  private Collection $products;

  public function getId(): int
  {
    return $this->id;
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

  public function getProducts(): Collection
  {
    return $this->products;
  }
}
