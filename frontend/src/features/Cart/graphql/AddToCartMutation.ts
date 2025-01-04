import { gql } from '@apollo/client'

/**
 * GraphQL mutation for adding items to the cart.
 *
 * This mutation takes an array of `CartItemInput` objects and adds them to the cart.
 */
export const ADD_TO_CART = gql`
  mutation AddToCart($cartItems: [CartItemInput!]!) {
    addToCart(cartItems: $cartItems)
  }
`
