import { gql, useQuery } from '@apollo/client'
import { useParams } from 'react-router'

import Card from '../../../components/Card/Card'
import { useNavigationContext } from '../../../providers/NavigationProvider'
import { useCart } from '../../Cart/providers/CartProvider.'
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

/**
 * The `Catalog` component fetches and displays a list of product categories and products
 * based on the selected category. It uses GraphQL queries to retrieve the data and
 * provides navigation to individual product pages.
 */
export default function Catalog() {
  const categories = useQuery(GET_CATEGORIES)
  const { category } = useParams()
  const { navigate } = useNavigationContext()
  const cart = useCart()

  const products = useQuery(GET_PRODUCTS, {
    variables: { category },
  })

  const addToCart = async (product: IProduct) => {
    const options = product.attributes.reduce(
      (acc, a) => {
        acc[a.id] = a.items[0].id
        return acc
      },
      {} as { [x: string]: string },
    )

    await cart.addToCart({
      options,
      price: product.prices,
      productId: product.id,
      quantity: 1,
    })

    cart.openModal()
  }

  /**
   * Handles the click event for a product item.
   *
   * @param {string} id - The unique identifier of the product.
   */
  const onClick = (id: string) => {
    navigate(`product/${id}`)
  }

  if (categories.loading || products.loading) {
    return (
      <>
        <h1 className="placeholder-glow fs-0">
          <span
            className="placeholder col-2 placeholder-xl"
            aria-label="Loading category name"
          ></span>
        </h1>
        <div
          className="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-4 mt-sm-3 mt-lg-7"
          aria-live="polite"
        >
          {Array.from([1, 2, 3, 4, 5, 6]).map((_, index) => (
            <div
              key={index}
              className="p-3 placeholder-glow gap-4 d-flex flex-column"
              style={{ height: 422 }}
              aria-label="Loading product"
            >
              <div
                className="placeholder p-md-3"
                style={{ width: '100%', height: 330 }}
                aria-label="Loading product image"
              ></div>
              <div className="d-flex flex-column gap-1">
                <p
                  className="placeholder col-5 fs-4 m-0"
                  aria-label="Loading product name"
                ></p>
                <span>
                  ${' '}
                  <p
                    className="placeholder col-2 fs-4 m-0"
                    aria-label="Loading product price"
                  ></p>
                </span>
              </div>
            </div>
          ))}
        </div>
      </>
    )
  }

  return (
    <>
      <span
        className="fs-0 fw-normal text-capitalize"
        aria-label={`Category: ${category}`}
      >
        {category}
      </span>
      <div
        className="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-4 mt-sm-3 mt-lg-7"
        aria-live="polite"
      >
        {products.data.products.map((product: IProduct, index: number) => (
          <Card
            onClick={() => onClick(product.id)}
            onButtonClick={() => addToCart(product)}
            key={index}
            src={product.gallery[0].imageUrl}
            name={product.name}
            inStock={product.inStock}
            price={
              product.prices[0].currency.symbol +
              product.prices[0].amount.toFixed(2)
            }
            aria-label={`Product: ${product.name}, Price: ${product.prices[0].currency.symbol}${product.prices[0].amount.toFixed(2)}`}
          />
        ))}
      </div>
    </>
  )
}
