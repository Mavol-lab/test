import IProductAttributeItem from './IProductAttributeItem'

/**
 * Interface that describes a product attribute.
 */
export default interface IProductAttribute {
  /**
   * Unique identifier for the attribute.
   */
  id: string

  /**
   * Name of the attribute (e.g., "Color", "Capacity").
   */
  name: string

  /**
   * Type of the attribute (e.g., "text", "swatch").
   */
  type: string

  /**
   * List of attribute items.
   */
  items: IProductAttributeItem[]
}
