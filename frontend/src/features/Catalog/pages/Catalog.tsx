import { useQuery } from '@apollo/client'
import { useParams } from 'react-router'

import { useNavigationContext } from '../../../providers/NavigationProvider'
import { useCart } from '../../Cart/providers/CartProvider.'
import {
  GET_PRODUCTS,
  TGetProductsQuery,
  TGetProductsResult,
} from '../../Product/graphql/GetProductsQuery'
import IProduct from '../../Product/models/IProduct'
import CatalogCard from '../components/Card/CatalogCard'
import CatalogPlaceholder from '../components/CatalogPlaceholder'

/**
 * The `Catalog` component fetches and displays a list of product categories and products
 * based on the selected category. It uses GraphQL queries to retrieve the data and
 * provides navigation to individual product pages.
 */
export default function Catalog() {
  const { category } = useParams()
  const { navigate } = useNavigationContext()
  const cart = useCart()

  const getProductsState = useQuery<TGetProductsResult, TGetProductsQuery>(
    GET_PRODUCTS,
    {
      variables: { category: category ?? '' },
      skip: !category,
    },
  )

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

  if (getProductsState.loading || !getProductsState.data) {
    return <CatalogPlaceholder />
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
        {getProductsState.data.products.map(
          (product: IProduct, index: number) => (
            <CatalogCard
              onClick={() => onClick(product.id)}
              onCartButtonClick={() => addToCart(product)}
              key={index}
              image={product.gallery[0].imageUrl}
              name={product.name}
              inStock={product.inStock}
              price={
                product.prices[0].currency.symbol +
                product.prices[0].amount.toFixed(2)
              }
              aria-label={`Product: ${product.name}, Price: ${product.prices[0].currency.symbol}${product.prices[0].amount.toFixed(2)}`}
            />
          ),
        )}
      </div>
    </>
  )
}
