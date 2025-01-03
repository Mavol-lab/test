<?php

namespace App\GraphQL\Query;

use App\GraphQL\Dto\Product\ProductDto;
use App\GraphQL\Type\Product\Output\ProductCategoryOutputType;
use App\GraphQL\Type\Product\Output\ProductOutputType;
use GraphQL\Type\Definition\Type;
use App\Service\ProductService;
use App\Utils\ExceptionHandlerTrait;

/**
 * This class handles GraphQL queries related to products.
 */
class ProductQuery
{
    use ExceptionHandlerTrait;

    protected ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Retrieves all products.
     *
     * @return array An array of all products.
     */
    public function getAll(): array
    {
        return [
            'type' => Type::listOf(ProductOutputType::getInstance()),
            'args' => [
                'category' => [
                    'type' => Type::string(),
                ],
            ],
            'resolve' => fn(mixed $root, array $args): array => $this->handleExceptions(
                fn() => $this->productService->getAllProducts($args['category']),
                'Failed to fetch products'
            )
        ];
    }

    /**
     * Retrieves an array of products.
     *
     * @return array An array of products.
     */
    public function get(): array
    {
        return [
            'type' => ProductOutputType::getInstance(),
            'args' => [
                'id' => [
                    'type' => Type::string(),
                ],
            ],
            'resolve' => fn(mixed $root, array $args): ProductDto => $this->handleExceptions(
                fn(): ProductDto => $this->productService->getProductById($args['id']),
                'Failed to fetch product'
            )
        ];
    }

    /**
     * Retrieves a list of product categories.
     *
     * @return array An array of product categories.
     */
    public function getCategories(): array
    {
        return [
            'type' => Type::listOf(ProductCategoryOutputType::getInstance()),
            'resolve' => fn(): array => $this->handleExceptions(
                fn(): array => $this->productService->getAllCategories(),
                'Failed to fetch categories'
            )
        ];
    }
}
