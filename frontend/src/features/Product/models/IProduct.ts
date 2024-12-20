import IProductAttribute from './IProductAttribute'
import IProductCategory from './IProductCategory'
import IProductGallery from './IProductGallery'
import IProductPrice from './IProductPrice'

/**
 * Interface that describes a product in the system.
 */
export default interface IProduct {
  /**
   * Unique identifier for the product.
   */
  id: string

  /**
   * Name of the product.
   */
  name: string

  /**
   * Indicates whether the product is in stock.
   */
  inStock: boolean

  /**
   * Detailed description of the product.
   */
  description: string

  /**
   * Brand of the product.
   */
  brand: string

  /**
   * Categories the product belongs to.
   */
  category: IProductCategory[]

  /**
   * Product image gallery.
   */
  gallery: IProductGallery[]

  /**
   * Price details for the product.
   */
  prices: IProductPrice[]

  /**
   * Product's additional attributes (e.g., color, size).
   */
  attributes: IProductAttribute[]
}
