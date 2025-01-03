<?php

namespace App\Repository;

use App\Models\Product;
use App\Utils\ExceptionCode;
use Doctrine\ORM\EntityRepository;

/**
 * This class extends the EntityRepository and provides methods to interact with the Product entity.
 * @extends EntityRepository<Product>
 */
class ProductRepository extends EntityRepository
{
    /**
     * Retrieves all products belonging to the specified category.
     *
     * @param string $category The category of products to retrieve.
     * @return array An array of products in the specified category.
     */
    public function getAll(string $category): array
    {
        try {
            $query = $this->createQueryBuilder('p')
                ->leftJoin('p.prices', 'prices')
                ->leftJoin('prices.currency', 'currency')
                ->leftJoin('p.gallery', 'gallery')
                ->leftJoin('p.category', 'category')
                ->leftJoin('p.attributes', 'attributes')
                ->leftJoin('attributes.items', 'attributeItems')
                ->addSelect('gallery', 'category', 'currency', 'prices', 'attributes', 'attributeItems');

            if ($category !== 'all') {
                $query
                    ->where('category.name = :category')
                    ->setParameter('category', $category);
            }

            return $query->getQuery()->getResult();
        } catch (\Exception $e) {
            // Log $e->message
            throw new ExceptionCode(500, "Internal server error");
        }
    }

    /**
     * Retrieves a product by its ID.
     *
     * @param string $id The unique identifier of the product.
     * @return Product|null The product object if found, null otherwise.
     */
    function getProductById(string $id): ?Product
    {
        try {
            $query = $this->createQueryBuilder('p')
                ->leftJoin('p.prices', 'prices')
                ->leftJoin('prices.currency', 'currency')
                ->leftJoin('p.gallery', 'gallery')
                ->leftJoin('p.category', 'category')
                ->leftJoin('p.attributes', 'attributes')
                ->leftJoin('attributes.items', 'attributeItems')
                ->addSelect('gallery', 'category', 'currency', 'prices', 'attributes', 'attributeItems')
                ->where('p.id = :id')
                ->setParameter('id', $id)
                ->getQuery();

            return $query->getOneOrNullResult();
        } catch (\Exception $e) {
            // Log $e->message
            throw new ExceptionCode(500, "Internal server error");
        }
    }

    /**
     * Adds a new product to the repository.
     *
     * @param Product $product The product to add.
     * @return Product The added product.
     */
    public function add(Product $product): Product
    {
        try {
            $this->persist($product);
            $this->flush();

            return $product;
        } catch (\Exception $e) {
            // Log $e->message
            throw new ExceptionCode(500, "Internal server error");
        }
    }
}
