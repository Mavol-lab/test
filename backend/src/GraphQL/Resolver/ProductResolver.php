<?php

namespace App\GraphQL\Resolver;

use App\GraphQL\Mutation\CartMutation;
use App\GraphQL\Mutation\ProductMutation;
use App\GraphQL\Query\ProductQuery;
use GraphQL\Type\Definition\ObjectType;
use App\Service\ProductService;

/**
 * This class is responsible for resolving GraphQL queries and mutations related to products.
 */
class ProductResolver
{
    /**
     * @var ProductService $productService
     * The service used to handle product-related operations.
     */
    private ProductService $productService;

    /**
     * ProductResolver constructor.
     *
     * @param ProductService $productService
     * The service used to handle product-related operations.
     */
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Returns the GraphQL query type definition.
     *
     * @return ObjectType
     * The GraphQL query type definition.
     */
    public function getQueryType(): ObjectType
    {
        $productQuery = new ProductQuery($this->productService);

        return new ObjectType([
            'name' => 'Query',
            'fields' => [
                'categories' => $productQuery->getCategories(),
                'products' => $productQuery->getAll(),
                'product' => $productQuery->get(),
            ]
        ]);
    }

    /**
     * Returns the GraphQL mutation type definition.
     *
     * @return ObjectType
     * The GraphQL mutation type definition.
     */
    public function getMutationType(): ObjectType
    {
        $cartMutation = new CartMutation($this->productService);
        $productMutation = new ProductMutation($this->productService);

        return new ObjectType([
            'name' => 'Mutation',
            'fields' => [
                'addToCart' => $cartMutation->add(),
                'addProduct' => $productMutation->add()
            ],
        ]);
    }
}
