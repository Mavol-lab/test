import { useCart } from '../../features/Cart/providers/CartProvider.'
import Button from '../Button/Button'
import ButtonColor from '../Button/types/ButtonColor'
import ButtonType from '../Button/types/ButtonType'

type TProps = {
  /**
   * Function to be called when the button is clicked.
   */
  onClick: () => void
}

/**
 * HeaderCartButton component renders a button that displays the current number of items in the cart.
 * It uses the `useCart` hook to get the cart information and displays a badge with the item count if there are items in the cart.
 */
function HeaderCartButton(props: TProps) {
  const cart = useCart()

  return (
    <div className="col d-flex justify-content-end align-items-start">
      <Button
        className="p-2"
        color={ButtonColor.Secondary}
        type={ButtonType.Transparent}
        onClick={props.onClick}
        testId="cart-btn"
        aria-label="Cart"
      >
        <div className="position-relative">
          <i className="icon icon-cart position-relative" aria-hidden="true" />
          {cart.itemCount() > 0 && (
            <span className="badge fs-7" aria-live="polite">
              <span className="font-roboto">{cart.itemCount()}</span>
              <span className="visually-hidden">Cart item count</span>
            </span>
          )}
        </div>
      </Button>
    </div>
  )
}

export default HeaderCartButton
