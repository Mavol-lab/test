import { gql } from '@apollo/client'

import IProduct from '../models/IProduct'

export type TGetProductResult = {
  product: IProduct
}

export type TGetProductQuery = {
  id: string
}

/**
 * GraphQL query to fetch product details by ID.
 */
export const GET_PRODUCT = gql`
  query GetProduct($id: String!) {
    product(id: $id) {
      id
      name
      inStock
      description
      brand
      gallery {
        imageUrl
        id
      }
      category {
        name
      }
      prices {
        amount
        currency {
          label
          symbol
        }
      }
      attributes {
        id
        name
        type
        items {
          displayValue
          value
          id
        }
      }
    }
  }
`
