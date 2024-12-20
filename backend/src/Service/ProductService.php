<?php

namespace App\Service;

use App\Entity\Category;
use App\Repository\ProductRepository;
use App\Entity\Product;
use App\Entity\ProductAttribute;
use App\Entity\ProductAttributeItem;
use App\Entity\ProductGallery;
use App\Entity\ProductPrice;
use App\Repository\CategoryRepository;
use HTMLPurifier;

class ProductService
{
  private ProductRepository $productRepository;
  private CategoryRepository $categoryRepository;
  private HTMLPurifier $purifier;

  public function __construct(ProductRepository $productRepository, CategoryRepository $categoryRepository)
  {
    $this->productRepository = $productRepository;
    $this->categoryRepository = $categoryRepository;
    $this->purifier = getPurifier();
  }

  public function getAllProducts(): array
  {
    $products = $this->productRepository->getAll();

    return array_map(function ($product) {
      $gallery = array_map(function (ProductGallery $item) {
        return [
          'id' => $item->getId(),
          'imageUrl' => $this->purifier->purify($item->getImageUrl())
        ];
      }, $product->getGallery()->toArray());

      $prices = array_map(function (ProductPrice $item) {
        return [
          'id' => $item->getId(),
          'amount' => $item->getAmount(),
          'currency' => [
            'id' => $item->getCurrency()->getId(),
            'label' => $item->getCurrency()->getLabel(),
            'symbol' => $item->getCurrency()->getSymbol(),
          ]
        ];
      }, $product->getPrices()->toArray());

      $attributes = array_map(function (ProductAttribute $attribute) {
        return [
          'id' => $attribute->getId(),
          'name' => $attribute->getName(),
          'type' => $attribute->getType(),
          'items' => array_map(function (ProductAttributeItem $item) {
            return [
              'id' => $item->getId(),
              'displayValue' => $item->getDisplayValue(),
              'value' => $item->getValue()
            ];
          }, $attribute->getItems()->toArray())
        ];
      }, $product->getAttributes()->toArray());

      return [
        'id' => $product->getId(),
        'name' => $product->getName(),
        'inStock' => $product->getInStock(),
        'description' => $product->getDescription(),
        'brand' => $product->getBrand(),
        'gallery' => $gallery,
        'category' =>  [
          'id' => $product->getCategory()->getId(),
          'name' => $product->getCategory()->getName()
        ],
        'prices' => $prices,
        'attributes' => $attributes,
      ];
    }, $products);
  }

  public function getAllCategories(): array
  {
    return $this->categoryRepository->getAllCategories();;
  }

  public function getProductById(string $id)
  {
    $product = $this->productRepository->getProductById($id);

    $gallery = array_map(function (ProductGallery $item) {
      return [
        'id' => $item->getId(),
        'imageUrl' => $this->purifier->purify($item->getImageUrl())
      ];
    }, $product->getGallery()->toArray());

    $prices = array_map(function (ProductPrice $item) {
      return [
        'id' => $item->getId(),
        'amount' => $item->getAmount(),
        'currency' => [
          'id' => $item->getCurrency()->getId(),
          'label' => $item->getCurrency()->getLabel(),
          'symbol' => $item->getCurrency()->getSymbol(),
        ]
      ];
    }, $product->getPrices()->toArray());

    $attributes = array_map(function (ProductAttribute $attribute) {
      return [
        'id' => $attribute->getId(),
        'name' => $attribute->getName(),
        'type' => $attribute->getType(),
        'items' => array_map(function (ProductAttributeItem $item) {
          return [
            'id' => $item->getId(),
            'displayValue' => $item->getDisplayValue(),
            'value' => $item->getValue()
          ];
        }, $attribute->getItems()->toArray())
      ];
    }, $product->getAttributes()->toArray());

    return [
      'id' => $product->getId(),
      'name' => $product->getName(),
      'inStock' => $product->getInStock(),
      'description' => $product->getDescription(),
      'brand' => $product->getBrand(),
      'gallery' => $gallery,
      'category' =>  [
        'id' => $product->getCategory()->getId(),
        'name' => $product->getCategory()->getName()
      ],
      'prices' => $prices,
      'attributes' => $attributes,
    ];
  }

  public function addProduct(array $data): Product
  {
    $product = new Product($data['name'], $data['price'], $data['description']);
    return $this->productRepository->add($product);
  }
}
