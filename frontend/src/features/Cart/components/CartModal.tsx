import './Cart.scss'

import classNames from 'classnames'

import Button from '../../../components/Button/Button'
import ButtonColor from '../../../components/Button/types/ButtonColor'
import ButtonType from '../../../components/Button/types/ButtonType'
import { useCart } from '../providers/CartProvider.'
import CartModalCard from './CartModalCard'

function CartModal() {
  const cart = useCart()

  return (
    <div
      onClick={cart.closeModal}
      className={classNames(
        'cart-modal position-absolute w-100 h-100 top-0 start-0 d-flex justify-content-end align-items-start',
        { visible: cart.isModalVisible },
      )}
    >
      {/** Creating 1 extra container so that the modal window matches the cart */}
      <div className="container-xxl d-flex justify-content-end">
        <div
          onClick={(e) => e.stopPropagation()}
          className="bg-white modal px-4 py-5 d-flex flex-column gap-5 position-sticky top-0 end-0"
        >
          <div>
            <span className="fw-bold">My Bag, </span>
            <span className="fw-medium" data-testid="cart-total">
              {`${cart.cart.length} ${cart.cart.length === 1 ? 'item' : 'items'}`}
            </span>
          </div>

          {cart.itemCount() > 0 ? (
            <div
              className="overflow-y-scroll gap-5 d-flex flex-column"
              style={{ height: 300 }}
            >
              {cart.cart.map((item, i) => (
                <CartModalCard {...item} key={i} />
              ))}
            </div>
          ) : (
            <div className="text-center opacity-50 p-6">Your cart is empty</div>
          )}

          <div className="d-flex justify-content-between">
            <span className="fw-bold text-capitalize">Total</span>
            <span className="fw-bold">${cart.calculateTotal().toFixed(2)}</span>
          </div>

          <Button
            className="p-3 w-100"
            color={ButtonColor.Primary}
            type={ButtonType.Solid}
            isDisabled={cart.itemCount() === 0}
          >
            <span>PLACE ORDER</span>
          </Button>
        </div>
      </div>
    </div>
  )
}

export default CartModal
