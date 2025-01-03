<?php

namespace App\Models;

use App\Models\Abstract\ProductBase;
use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * This class extends the ProductBase class and represents a product in the application.
 */
#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[ORM\Table('products')]
class Product extends ProductBase
{
    public function __construct(
        string $name,
        bool $inStock,
        string $description,
        string $brand,
        Category $category
    ) {
        parent::__construct(
            $name,
            $inStock,
            $description,
            $brand,
            $category
        );
    }
}
