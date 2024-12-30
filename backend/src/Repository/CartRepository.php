<?php

namespace App\Repository;

use App\Entity\Cart;
use App\Entity\CartItem;
use App\Entity\CartItemAttribute;
use Doctrine\ORM\EntityRepository;

class CartRepository extends EntityRepository
{
  /**
   * @param CartItem[] $items array of products.
   */
  public function addToCart(array $items): bool
  {
    try {
      $cart = new Cart();

      foreach ($items as $item) {
        $cartItem = new CartItem($cart, $item['productId'], $item['quantity']);

        foreach ($item['attributes'] as $attribute) {
          $cartItemAttribute = new CartItemAttribute($cartItem, $attribute['name'], $attribute['value']);

          $cartItem->addAttribute($cartItemAttribute);
        }

        $cart->addCartItem($cartItem);
      }

      $this->getEntityManager()->persist($cart);
      $this->getEntityManager()->flush();

      return true;
    } catch (\Exception $e) {
      error_log('Error: ' . $e->getMessage());
      error_log('Stack trace: ' . $e->getTraceAsString());
      echo $e->getMessage();
      echo $e->getTraceAsString();
      return false;
    }
  }
}
