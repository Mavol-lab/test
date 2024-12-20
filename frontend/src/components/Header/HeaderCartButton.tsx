import { useCart } from '../../features/Cart/providers/CartProvider.'
import Button from '../Button/Button'
import ButtonColor from '../Button/types/ButtonColor'
import ButtonType from '../Button/types/ButtonType'

type TProps = {
  onClick: () => void
}

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
      >
        <div className="position-relative">
          <i className="icon icon-cart position-relative" />
          {cart.itemCount() > 0 && (
            <span className="badge fs-7">
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
