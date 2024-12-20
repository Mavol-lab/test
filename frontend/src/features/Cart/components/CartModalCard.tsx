import { gql, useQuery } from '@apollo/client'
import { useEffect, useMemo, useState } from 'react'

import Button from '../../../components/Button/Button'
import ButtonColor from '../../../components/Button/types/ButtonColor'
import ButtonType from '../../../components/Button/types/ButtonType'
import Form, { TFormSettings } from '../../../components/Form/Form'
import { toKebabCase } from '../../../utils/textFormat'
import IProduct from '../../Product/models/IProduct'
import { useCart } from '../providers/CartProvider.'

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

const GET_PRODUCT = gql`
  query GetProduct($id: String!) {
    product(id: $id) {
      id
      name
      inStock
      description
      brand
      gallery {
        imageUrl
        id
      }
      category {
        name
      }
      prices {
        amount
        currency {
          label
          symbol
        }
      }
      attributes {
        id
        name
        type
        items {
          displayValue
          value
          id
        }
      }
    }
  }
`

function CartModalCard(props: TProps) {
  const cart = useCart()
  const { loading, error, data } = useQuery<{ product: IProduct }>(
    GET_PRODUCT,
    {
      variables: { id: props.productId },
    },
  )
  const [form, setForm] = useState<{ [x: string]: string }>(props.options)
  const price = data?.product.prices[0]

  useEffect(() => {
    setForm(props.options)
  }, [props.options])

  const generateSettings = useMemo((): TFormSettings<{
    [x: string]: string
  }>[] => {
    if (data) {
      // Map product attributes into form settings.
      return data.product.attributes.map((o, i) => {
        return {
          inputProps: {
            type: o.type === 'swatch' ? 'color' : 'switch',
            label: o.name,
            readonly: true,
            modal: true,
            values: o.items.map((i) => {
              return {
                key: i.value,
                name: i.displayValue,
                testId: `cart-item-attribute-${toKebabCase(o.name)}-${toKebabCase(o.name)}`,
              }
            }),
            testId: `cart-item-attribute-${toKebabCase(o.name)}`,
          },
          key: o.id,
        }
      })
    }

    return [] // Return an empty array if there's no data.
  }, [data])

  return (
    <div className="d-flex gap-2">
      <div className="d-flex flex-column text-truncate">
        <span title={data?.product.name}>{data?.product.name}</span>
        <div className="fs-6 fw-bold text-uppercase">
          <span title={price?.currency.label}>{price?.currency.symbol}</span>
          <span>{price?.amount}</span>
        </div>
        <Form
          updateForm={console.log}
          form={form}
          settings={generateSettings}
        />
      </div>
      <div className="d-flex flex-column justify-content-between align-items-center">
        <Button
          className="p-1"
          color={ButtonColor.Secondary}
          type={ButtonType.Outline}
          onClick={() =>
            cart.addToCart({
              ...props,
              quantity: 1,
              price: data?.product.prices,
            })
          }
          testId="cart-item-amount-increase"
        >
          <i className="icon icon-plus p-1" />
        </Button>
        <span className="fw-medium" data-testid="cart-item-amount">
          {props.quantity}
        </span>
        <Button
          className="p-1"
          color={ButtonColor.Secondary}
          type={ButtonType.Outline}
          onClick={() => {
            cart.removeFromCart(props.id)
          }}
          testId="cart-item-amount-decrease"
        >
          <i className="icon icon-minus p-1" />
        </Button>
      </div>
      <div className="d-flex align-items-center">
        <img width={121} src={data?.product.gallery[0].imageUrl} />
      </div>
    </div>
  )
}

export default CartModalCard
