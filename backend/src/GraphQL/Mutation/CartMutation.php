<?php

namespace App\GraphQL\Mutation;

use App\Config\AutoMapperSingleton;
use App\GraphQL\Input\Cart\CartInput;
use App\GraphQL\Type\Cart\CartItemInputType;
use GraphQL\Type\Definition\Type;
use App\Service\ProductService;
use App\Utils\ExceptionCode;
use App\Utils\ExceptionHandlerTrait;

/**
 * This class contains GraphQL mutations related to the shopping cart.
 * It provides methods to handle various cart operations.
 */
final class CartMutation
{
    use ExceptionHandlerTrait;

    protected ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Adds an item to the cart.
     *
     * @return array The updated cart details.
     */
    public function add(): array
    {
        return [
            'type' => Type::boolean(),
            'args' => [
                'cartItems' => Type::listOf(CartItemInputType::getInstance())
            ],
            'resolve' => function (mixed $root, array $args) {
                $cart = AutoMapperSingleton::map($args, CartInput::class);

                if ($cart instanceof CartInput) {
                    return $this->productService->addToCart($cart);
                }

                throw new ExceptionCode(400, "Invalid data");
            }
        ];
    }
}
