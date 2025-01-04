import Button from '../../../../components/Button/Button'
import ButtonColor from '../../../../components/Button/types/ButtonColor'
import ButtonType from '../../../../components/Button/types/ButtonType'

type TProps = {
  /**
   * Function to call when increasing the quantity.
   */
  onIncrease?: () => void

  /**
   * Function to call when decreasing the quantity.
   */
  onDecrease?: () => void

  /**
   * The current quantity of the product.
   */
  quantity?: number
}

/**
 * Component for rendering controls to increase or decrease the quantity of a product in the cart.
 */
const CartProductCardControls = (props: TProps) => {
  return (
    <>
      <Button
        className="p-1"
        color={ButtonColor.Secondary}
        type={ButtonType.Outline}
        onClick={props.onIncrease}
        testId={props.onIncrease ? 'cart-item-amount-increase' : ''}
        aria-label="Increase quantity"
      >
        <i className="icon icon-plus p-1" />
      </Button>
      {props.quantity ? (
        <span
          className="fw-medium"
          data-testid="cart-item-amount"
          aria-label={`Quantity: ${props.quantity}`}
        >
          {props.quantity}
        </span>
      ) : (
        <span className="placeholder col-10"></span>
      )}
      <Button
        className="p-1"
        color={ButtonColor.Secondary}
        type={ButtonType.Outline}
        onClick={props.onDecrease}
        testId={props.onDecrease ? 'cart-item-amount-decrease' : ''}
        aria-label="Decrease quantity"
      >
        <i className="icon icon-minus p-1" />
      </Button>
    </>
  )
}

export default CartProductCardControls
