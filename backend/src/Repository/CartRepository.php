<?php

namespace App\Repository;

use App\GraphQL\Input\Cart\CartInput;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\CartItemAttribute;
use App\Utils\ExceptionCode;
use Doctrine\ORM\EntityRepository;

/**
 * This class extends the EntityRepository and provides methods to interact with the Cart entity.
 * @extends EntityRepository<Cart>
 */
class CartRepository extends EntityRepository
{
    /**
     * Adds an item to the cart.
     *
     * @param CartInput $input The input data for the cart item to be added.
     * @return bool Returns true if the item was successfully added, false otherwise.
     */
    public function addToCart(CartInput $input): bool
    {
        try {
            $cart = new Cart();

            foreach ($input->cartItems as $item) {
                $cartItem = new CartItem($cart, $item->productId, $item->quantity);

                foreach ($item->attributes as $attribute) {
                    $cartItemAttribute = new CartItemAttribute($cartItem, $attribute->id, $attribute->value);

                    $cartItem->addAttribute($cartItemAttribute);
                }

                $cart->addCartItem($cartItem);
            }

            $this->getEntityManager()->persist($cart);
            $this->getEntityManager()->flush();

            return true;
        } catch (\Exception $e) {
            // Log $e->message
            throw new ExceptionCode(500, "Internal server error");
        }
    }
}
