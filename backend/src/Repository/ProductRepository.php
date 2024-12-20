<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\ORM\EntityRepository;

class ProductRepository extends EntityRepository
{
  public function getAll(): array
  {
    try {
      $query = $this->createQueryBuilder('p')
        ->leftJoin('p.prices', 'prices')
        ->leftJoin('prices.currency', 'currency')
        ->leftJoin('p.gallery', 'gallery')
        ->leftJoin('p.category', 'category')
        ->leftJoin('p.attributes', 'attributes') // Добавляем связь с атрибутами
        ->leftJoin('attributes.items', 'attributeItems') // Добавляем связь с элементами атрибутов
        ->addSelect('gallery', 'category', 'currency', 'prices', 'attributes', 'attributeItems') // Указываем, что связанные сущности нужно выбирать
        ->getQuery();

      return $query->getResult();
    } catch (\Exception $e) {
      echo 'Error: ' . $e->getMessage() . PHP_EOL;
      error_log('Error in ProductRepository::getAll: ' . $e->getMessage());
      return null;
    }
  }

  function getProductById(string $id)
  {
    try {
      $query = $this->createQueryBuilder('p')
        ->leftJoin('p.prices', 'prices')
        ->leftJoin('prices.currency', 'currency')
        ->leftJoin('p.gallery', 'gallery')
        ->leftJoin('p.category', 'category')
        ->leftJoin('p.attributes', 'attributes') // Добавляем связь с атрибутами
        ->leftJoin('attributes.items', 'attributeItems') // Добавляем связь с элементами атрибутов
        ->addSelect('gallery', 'category', 'currency', 'prices', 'attributes', 'attributeItems') // Указываем, что связанные сущности нужно выбирать
        ->where('p.id = :id')
        ->setParameter('id', $id)
        ->getQuery();

      return $query->getOneOrNullResult();
    } catch (\Exception $e) {
      echo 'Error: ' . $e->getMessage() . PHP_EOL;
      error_log('Error in ProductRepository::getAll: ' . $e->getMessage());
      return null;
    }
  }

  public function add(Product $product): Product
  {
    $this->persist($product);
    $this->flush();
    return $product;
  }
}
