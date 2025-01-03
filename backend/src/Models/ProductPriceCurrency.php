<?php

namespace App\Models;

use Doctrine\ORM\Mapping as ORM;


/**
 * This class represents the currency associated with a product's price.
 * It is used to handle currency-related operations for product pricing.
 */
#[ORM\Entity]
#[ORM\Table(name: "currencies")]
class ProductPriceCurrency
{

    /**
     * @var int $id The unique identifier for the product price currency.
     */
    #[ORM\Id]
    #[ORM\Column(type: "integer")]
    #[ORM\GeneratedValue]
    private int $id;

    /**
     * @var string $label The label for the product price currency.
     */
    #[ORM\Column(type: "string", length: 255)]
    private string $label;

    /**
     * @var string The symbol representing the currency.
     */
    #[ORM\Column(type: "string", length: 10)]
    private string $symbol;

    public function __construct(string $label, string $symbol)
    {
        $this->label = $label;
        $this->symbol = $symbol;
    }

    /**
     * Get the ID of the ProductPriceCurrency.
     *
     * @return int The ID of the ProductPriceCurrency.
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Get the label of the product price currency.
     *
     * @return string The label of the product price currency.
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * Set the label of the product price currency.
     *
     * @param string $label The label to set.
     * @return self
     */
    public function setLabel(string $label): self
    {
        $this->label = $label;
        return $this;
    }

    /**
     * Get the currency symbol.
     *
     * @return string The currency symbol.
     */
    public function getSymbol(): string
    {
        return $this->symbol;
    }

    /**
     * Set the currency symbol.
     *
     * @param string $symbol The currency symbol to set.
     * @return self
     */
    public function setSymbol(string $symbol)
    {
        $this->symbol = $symbol;
        return $this;
    }
}
