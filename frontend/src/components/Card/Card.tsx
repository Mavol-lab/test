import './Card.scss'

import classNames from 'classnames'

import { toKebabCase } from '../../utils/textFormat'
import Button from '../Button/Button'
import ButtonColor from '../Button/types/ButtonColor'
import ButtonType from '../Button/types/ButtonType'

type TProps = {
  src: string
  onClick: () => void
  name: string
  price: string
  inStock: boolean
}

function Card(props: TProps) {
  return (
    <div
      className="p-0 p-md-3"
      onClick={props.onClick}
      data-testid={`product-${toKebabCase(props.name)}`}
    >
      <div className="d-flex flex-column gap-4 p-3 card">
        <div className="position-relative">
          <div className={classNames(['position-relative'])}>
            <img
              className={classNames([
                { 'in-stock': props.inStock, 'opacity-25': !props.inStock },
                'w-100',
              ])}
              height={330}
              src={props.src}
            />
            <span
              className={classNames([
                { 'd-none': props.inStock },
                'opacity-50 position-absolute top-50 start-50 translate-middle fs-3 w-100 text-center',
              ])}
            >
              OUT OF STOCK
            </span>
          </div>
          <Button
            color={ButtonColor.Primary}
            type={ButtonType.Solid}
            className={classNames([
              { 'd-none': !props.inStock },
              'rounded-circle p-3 position-absolute top-100 end-0',
            ])}
          >
            <i className="icon icon-cart bg-white p-3" />
          </Button>
        </div>
        <div className="d-flex flex-column gap-1">
          <span className="fw-light">{props.name}</span>
          <span
            className={classNames([
              { 'opacity-50': !props.inStock },
              'fw-medium',
            ])}
          >
            {props.price}
          </span>
        </div>
      </div>
    </div>
  )
}

export default Card
