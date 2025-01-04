import './Cart.scss'

import { useMutation } from '@apollo/client'
import classNames from 'classnames'

import Button from '../../../components/Button/Button'
import ButtonColor from '../../../components/Button/types/ButtonColor'
import ButtonType from '../../../components/Button/types/ButtonType'
import { ADD_TO_CART } from '../graphql/AddToCartMutation'
import ICart from '../models/ICart'
import { useCart } from '../providers/CartProvider.'
import CartProductCard from './Card/CartProductCard'

/**
 * Cart component renders a modal window displaying the items in the user's cart.
 * It allows users to view their cart items, see the total price, and place an order.
 */
function Cart() {
  const cart = useCart()

  const [addToCart, addToCartState] = useMutation<ICart>(ADD_TO_CART)

  const handleSubmit = async (): Promise<void> => {
    const cartItems = cart.cart.map((c) => {
      const attributes = Object.entries(c.options).map((o) => {
        return { id: o[0], value: o[1] }
      })

      return {
        productId: c.productId,
        quantity: c.quantity,
        attributes,
      }
    })

    const variables: ICart = {
      cartItems,
    }

    await addToCart({ variables })

    cart.clearCart()
  }

  const renderCartItems = () => (
    <div
      id="cart-modal-description"
      className="overflow-y-auto gap-5 d-flex flex-column"
      style={{ height: 300 }}
    >
      {cart.cart.map((item, index) => (
        <CartProductCard {...item} key={index} />
      ))}
    </div>
  )

  const renderEmptyCartMessage = () => (
    <div className="text-center opacity-50 p-6">Your cart is empty</div>
  )

  const isCartEmpty = cart.itemCount() === 0

  return (
    <div
      onClick={cart.closeModal}
      className={classNames(
        'z-1 cart-modal position-absolute w-100 h-100 d-flex justify-content-end align-items-start',
        { visible: cart.isModalVisible },
      )}
      role="dialog"
      data-testid="cart-overlay"
      aria-modal="true"
      aria-labelledby="cart-modal-title"
      aria-describedby="cart-modal-description"
    >
      <div className="container-xxl d-flex justify-content-end">
        <div
          onClick={(e) => e.stopPropagation()}
          className="bg-white modal px-4 py-5 d-flex flex-column gap-5 position-sticky top-0 end-0"
        >
          <div>
            <span id="cart-modal-title" className="fw-bold">
              My Bag,{' '}
            </span>
            <span className="fw-medium" data-testid="cart-total">
              {`${cart.cart.length} ${cart.cart.length === 1 ? 'item' : 'items'}`}
            </span>
          </div>

          {isCartEmpty ? renderEmptyCartMessage() : renderCartItems()}

          <div className="d-flex justify-content-between">
            <span className="fw-bold text-capitalize">Total</span>
            <span className="fw-bold">${cart.calculateTotal().toFixed(2)}</span>
          </div>

          <Button
            className="p-3 w-100"
            color={ButtonColor.Primary}
            type={ButtonType.Solid}
            isDisabled={cart.itemCount() === 0}
            onClick={handleSubmit}
          >
            <span>PLACE ORDER</span>
          </Button>
        </div>
      </div>
    </div>
  )
}

export default Cart
