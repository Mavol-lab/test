import ICartItemAttribute from './ICartItemAttribute'

/**
 * Represents an item in the shopping cart.
 */
export default interface ICartItem {
  /**
   * The unique product identifier.
   */
  productId: string

  /**
   * The value of items in the cart.
   */
  quantity: number

  /**
   * The list of selected item attributes.
   */
  attributes: ICartItemAttribute[]
}
