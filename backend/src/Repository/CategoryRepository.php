<?php

namespace App\Repository;

use App\Models\Category;
use App\Utils\ExceptionCode;
use Doctrine\ORM\EntityRepository;

/**
 * Repository class for managing Category entities.
 * @extends EntityRepository<Category>
 */
class CategoryRepository extends EntityRepository
{
    /** 
     * Retrieves all categories from the repository.
     *
     * @return array An array of categories.
     */
    public function getAllCategories(): array
    {
        try {
            $query = $this->createQueryBuilder('p')
                ->select('p.id, p.name')
                ->getQuery();

            return $query->getArrayResult();
        } catch (\Exception $e) {
            // Log $e->message
            throw new ExceptionCode(500, "Internal server error");
        }
    }

    /**
     * Retrieves a category by its id.
     *
     * @param string $id The name of the category to retrieve.
     * @return Category|null The category data or null if not found.
     */
    public function getCategory(string $id): ?Category
    {
        try {
            return $this->find($id);
        } catch (\Exception $e) {
            // Log $e->message
            throw new ExceptionCode(500, "Internal server error");
        }
    }
}
