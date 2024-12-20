/**
 * Interface that describes the currency of a product price.
 */
export default interface IProductPriceCurrency {
  /**
   * Unique identifier for the currency.
   */
  id: number

  /**
   * Label of the currency (e.g., "USD", "EUR").
   */
  label: string

  /**
   * Symbol of the currency (e.g., "$", "€").
   */
  symbol: string
}
