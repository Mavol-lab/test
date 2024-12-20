/**
 * Interface that describes an item of a product attribute.
 */
export default interface IProductAttributeItem {
  /**
   * Unique identifier for the attribute item.
   */
  id: string

  /**
   * Display value for the attribute item (e.g., "Red", "XL").
   */
  displayValue: string

  /**
   * Internal value of the attribute item (e.g., "red", "xl").
   */
  value: string
}
