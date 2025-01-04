import CartProductCardControls from './CartProductCardControls'

/**
 * A placeholder component for the CartProductCard.
 * This component displays a skeleton UI while the actual cart product data is being loaded.
 */
const CartProductCardPlaceholder = () => {
  return (
    <div className="d-flex gap-2 placeholder-glow">
      <div className="d-flex flex-column text-truncate flex-grow-1 gap-2">
        <span className="placeholder fs-3 col-8"></span>
        <span className="placeholder col-6"></span>
        <span className="placeholder col-5"></span>
        <span className="placeholder col-9"></span>
      </div>
      <div className="d-flex flex-column justify-content-between align-items-center">
        <CartProductCardControls />
      </div>
      <div className="d-flex align-items-center">
        <div style={{ width: 121, height: 121 }} className="placeholder"></div>
      </div>
    </div>
  )
}

export default CartProductCardPlaceholder
