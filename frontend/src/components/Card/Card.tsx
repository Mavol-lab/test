import './Card.scss'

import classNames from 'classnames'

import { toKebabCase } from '../../utils/textFormat'
import Button from '../Button/Button'
import ButtonColor from '../Button/types/ButtonColor'
import ButtonType from '../Button/types/ButtonType'

type TProps = {
  /**
   * The source URL for the image.
   */
  src: string

  /**
   * The function to call when the card is clicked.
   */
  onClick: () => void

  /**
   * The function to call when the button is clicked.
   */
  onButtonClick: () => void

  /**
   * The name of the item.
   */
  name: string

  /**
   * The price of the item.
   */
  price: string

  /**
   * Indicates whether the item is in stock.
   */
  inStock: boolean
}

/**
 * Card component that displays a product with its image, name, and price.
 * It also shows an "OUT OF STOCK" message and disables the cart button if the product is not in stock.
 */
function Card(props: TProps) {
  const onButtonClick = (e: React.MouseEvent) => {
    e.stopPropagation()
    props.onButtonClick()
  }

  return (
    <div
      className="p-0 p-md-3"
      onClick={props.onClick}
      data-testid={`product-${toKebabCase(props.name)}`}
      aria-label={`Product card for ${props.name}`}
    >
      <div className="d-flex flex-column gap-4 p-3 card">
        <div className="position-relative">
          <div className="position-relative">
            <img
              className={classNames('w-100', {
                'in-stock': props.inStock,
                'opacity-25': !props.inStock,
              })}
              height={330}
              src={props.src}
              alt={`Image of ${props.name}`}
            />
            {!props.inStock && (
              <span
                className="opacity-50 position-absolute top-50 start-50 translate-middle fs-3 w-100 text-center"
                aria-hidden="true"
              >
                OUT OF STOCK
              </span>
            )}
          </div>
          {props.inStock && (
            <Button
              color={ButtonColor.Primary}
              type={ButtonType.Solid}
              className="rounded-circle p-3 position-absolute top-100 end-0"
              aria-label="Add to cart"
              onClick={onButtonClick}
            >
              <i className="icon icon-cart bg-white p-3" />
            </Button>
          )}
        </div>
        <div className="d-flex flex-column gap-1">
          <span className="fw-light">{props.name}</span>
          <span
            className={classNames('fw-medium', {
              'opacity-50': !props.inStock,
            })}
          >
            {props.price}
          </span>
        </div>
      </div>
    </div>
  )
}

export default Card
