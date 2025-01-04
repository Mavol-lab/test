import { gql } from '@apollo/client'

import IProduct from '../models/IProduct'

export type TGetProductsResult = {
  products: IProduct[]
}

export type TGetProductsQuery = {
  category: string
}

/**
 * GraphQL query to fetch products based on a specific category.
 */
export const GET_PRODUCTS = gql`
  query GetProducts($category: String!) {
    products(category: $category) {
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
