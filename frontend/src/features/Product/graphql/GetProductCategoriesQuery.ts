import { gql } from '@apollo/client'

import IProductCategory from '../models/IProductCategory'

export type TGetProductCategoriesResult = {
  categories: IProductCategory[]
}

/**
 * GraphQL query to fetch product categories.
 */
export const GET_PRODUCT_CATEGORIES = gql`
  query {
    categories {
      name
    }
  }
`
