<?php

namespace App\GraphQL\Mutation;

use App\Config\AutoMapperSingleton;
use App\GraphQL\Input\Product\ProductInput;
use App\GraphQL\Type\Product\Input\ProductInputType;
use App\Service\ProductService;
use App\Utils\ExceptionCode;
use App\Utils\ExceptionHandlerTrait;
use GraphQL\Type\Definition\Type;

/**
 * This class contains GraphQL mutations related to products.
 * It is used to handle various product-related operations such as creating, updating, and deleting products.
 */
final class ProductMutation
{
    use ExceptionHandlerTrait;

    protected ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Adds a new product.
     *
     * @return array The result of the add operation.
     */
    public function add(): array
    {
        return [
            'type' => Type::boolean(),
            'args' => [
                'product' => ProductInputType::getInstance()
            ],
            'resolve' => function (mixed $root, array $args) {
                $product = AutoMapperSingleton::map($args, ProductInput::class);

                if ($product instanceof ProductInput) {
                    return $this->productService->addProduct($product);
                }

                throw new ExceptionCode(400, "Invalid data");
            }
        ];
    }
}
