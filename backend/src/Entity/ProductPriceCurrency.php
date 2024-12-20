<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "currencies")]
class ProductPriceCurrency
{
  #[ORM\Id]
  #[ORM\Column(type: "integer")]
  #[ORM\GeneratedValue]
  private int $id;

  #[ORM\Column(type: "string", length: 255)]
  private string $label;

  #[ORM\Column(type: "string", length: 10)]
  private string $symbol;

  public function getId(): int
  {
    return $this->id;
  }

  public function getLabel(): string
  {
    return $this->label;
  }

  public function setLabel(string $label)
  {
    $this->label = $label;
    return $this;
  }

  public function getSymbol(): string
  {
    return $this->symbol;
  }

  public function setSymbol(string $symbol)
  {
    $this->symbol = $symbol;
    return $this;
  }
}
