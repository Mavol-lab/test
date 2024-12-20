import { gql, useQuery } from '@apollo/client'
import { useParams } from 'react-router'

import Card from '../../../components/Card/Card'
import { useNavigationContext } from '../../../providers/NavigationProvider'
import IProduct from '../../Product/models/IProduct'

type TProps = {
  name: string
  price: number
}

const GET_CATEGORIES = gql`
  query {
    categories {
      name
    }
  }
`

const GET_PRODUCTS = gql`
  query {
    products {
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

export default function Catalog() {
  const categories = useQuery(GET_CATEGORIES)
  const products = useQuery(GET_PRODUCTS)
  const { category } = useParams()
  const { navigate } = useNavigationContext()

  const onClick = (id: string) => {
    navigate(`product/${id}`)
  }

  if (categories.loading || products.loading) return <p>Loading...</p>

  return (
    <>
      <span className="fs-0 fw-normal text-capitalize">{category}</span>
      <div className="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-4 mt-sm-3 mt-lg-7">
        {products.data.products.map((product: IProduct, index: number) => (
          <Card
            onClick={() => onClick(product.id)}
            key={index}
            src={product.gallery[0].imageUrl}
            name={product.name}
            inStock={product.inStock}
            price={
              product.prices[0].currency.symbol +
              product.prices[0].amount.toFixed(2)
            }
          />
        ))}
      </div>
    </>
  )
}
