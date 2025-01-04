import { useQuery } from '@apollo/client'

import {
  GET_PRODUCT,
  TGetProductQuery,
  TGetProductResult,
} from '../../../Product/graphql/GetProductQuery'
import { useCart } from '../../providers/CartProvider.'
import CartProductCardAttributes from './CartProductCardAttributes'
import CartProductCardControls from './CartProductCardControls'
import CartProductCardPlaceholder from './CartProductCardPlaceholder'

type TProps = {
  /**
   * Unique identifier for the cart item.
   */
  id: number

  /**
   * Unique identifier for the product.
   */
  productId: string

  /**
   * Quantity of this item in the cart.
   */
  quantity: number

  /**
   * A dynamic object for holding the name of the item (could be in different languages or formats).
   */
  options: { [x: string]: string }
}

/**
 * CartProductCard component displays a card with product details in the cart modal.
 * It fetches product data using a GraphQL query and allows users to update the cart.
 */
function CartProductCard(props: TProps) {
  const cart = useCart()
  const getProductQueryState = useQuery<TGetProductResult, TGetProductQuery>(
    GET_PRODUCT,
    {
      variables: { id: props.productId },
    },
  )

  const price = getProductQueryState.data?.product.prices[0]

  if (!getProductQueryState.data || getProductQueryState.loading) {
    return <CartProductCardPlaceholder />
  }

  return (
    <div className="d-flex gap-2">
      <div className="d-flex flex-column text-truncate flex-grow-1">
        <span title={getProductQueryState.data?.product.name}>
          {getProductQueryState.data?.product.name}
        </span>
        <div className="fs-6 fw-bold text-uppercase">
          <span
            title={price?.currency.label}
            aria-label={`Currency: ${price?.currency.label}`}
          >
            {price?.currency.symbol}
          </span>
          <span aria-label={`Price: ${price?.amount}`}>{price?.amount}</span>
        </div>
        <CartProductCardAttributes
          attributes={getProductQueryState.data}
          options={props.options}
        />
      </div>
      <div className="d-flex flex-column justify-content-between align-items-center">
        <CartProductCardControls
          onIncrease={() =>
            cart.addToCart({
              ...props,
              quantity: 1,
              price: getProductQueryState.data?.product.prices,
            })
          }
          onDecrease={() => {
            cart.removeFromCart(props.id)
          }}
          quantity={props.quantity}
        />
      </div>
      <div className="d-flex align-items-center">
        <img
          width={121}
          src={getProductQueryState.data?.product.gallery[0].imageUrl}
          alt={getProductQueryState.data?.product.name}
        />
      </div>
    </div>
  )
}

export default CartProductCard
