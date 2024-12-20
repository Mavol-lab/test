import IProductPriceCurrency from './IProductPriceCurrency'

/**
 * Interface that describes a product price.
 */
export default interface IProductPrice {
  /**
   * Unique identifier for the price.
   */
  id: number

  /**
   * Amount of the price.
   */
  amount: number

  /**
   * Currency details of the price.
   */
  currency: IProductPriceCurrency
}
