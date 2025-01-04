import './CatalogCard.scss'

import classNames from 'classnames'

import Button from '../../../../components/Button/Button'
import ButtonColor from '../../../../components/Button/types/ButtonColor'
import ButtonType from '../../../../components/Button/types/ButtonType'
import { toKebabCase } from '../../../../utils/textFormat'

type TProps = {
  /**
   * Function to be called when the card is clicked.
   */
  onClick: () => void

  /**
   * Function to be called when the cart button is clicked.
   */
  onCartButtonClick: () => void

  /**
   * Indicates if the item is in stock.
   */
  inStock: boolean

  /**
   * Name of the item.
   */
  name: string

  /**
   * URL of the item's image.
   */
  image: string

  /**
   * Price of the item.
   */
  price: string
}

/**
 * CatalogCard component represents a product card in the catalog.
 * It displays product information such as image, name, price, and stock status.
 */
const CatalogCard = (props: TProps) => {
  const onCartButtonClick = (e: React.MouseEvent) => {
    e.stopPropagation()
    props.onCartButtonClick()
  }

  return (
    <div
      className="p-0 p-md-3"
      onClick={props.onClick}
      data-testid={`product-${toKebabCase(props.name)}`}
      aria-label={`Product card for ${props.name}`}
    >
      <div className="d-flex flex-column gap-4 p-3 catalog-card">
        <div className="position-relative">
          <div className="position-relative">
            <img
              className={classNames('w-100', {
                'in-stock': props.inStock,
                'opacity-25': !props.inStock,
              })}
              height={330}
              src={props.image}
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
              onClick={onCartButtonClick}
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

export default CatalogCard
