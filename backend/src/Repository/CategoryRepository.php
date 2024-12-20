<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;

class CategoryRepository extends EntityRepository
{
  public function getAllCategories(): array
  {
    try {
      $query = $this->createQueryBuilder('p')
        ->select('p.id, p.name')
        ->getQuery();

      return $query->getArrayResult();
    } catch (\Exception $e) {
      echo 'Error: ' . $e->getMessage() . PHP_EOL;
      error_log('Error in CategoryRepository::getAllCategories: ' . $e->getMessage());
      return [];
    }
  }
}
