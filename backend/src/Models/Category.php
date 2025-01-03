<?php

namespace App\Models;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
#[ORM\Table('categories')]
/**
 * This class represents a category in the application.
 * It is used to manage and interact with category data.
 */
class Category
{
    /**
     * @var int $id The unique identifier for the category.
     */
    #[ORM\Id]
    #[ORM\GeneratedValue('AUTO')]
    #[ORM\Column(type: 'integer')]
    private int $id;

    /**
     * @var string $name The name of the category.
     */
    #[ORM\Column(type: 'string', length: 255)]
    private string $name;

    /**
     * @var Collection $products A collection of products associated with the category.
     */
    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Product::class)]
    private Collection $products;

    public function __construct(string $name, Collection $products)
    {
        $this->name = $name;
        $this->products = $products;
    }

    /**
     * Get the ID of the category.
     *
     * @return int The ID of the category.
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Get the name of the category.
     *
     * @return string The name of the category.
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the name of the category.
     *
     * @param string $name The name to set.
     * @return self Returns the instance of the Category for method chaining.
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Retrieve the collection of products associated with the category.
     *
     * @return Collection
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }
}
