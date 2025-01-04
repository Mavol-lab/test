import { useEffect, useMemo, useState } from 'react'

import Form, { TFormSettings } from '../../../../components/Form/Form'
import { toKebabCase } from '../../../../utils/textFormat'
import { TGetProductResult } from '../../../Product/graphql/GetProductQuery'

type TProps = {
  /**
   * A dictionary of options where the key is a string and the value is a string.
   */
  options: { [x: string]: string }

  /**
   * The attributes of the product.
   */
  attributes: TGetProductResult
}

/**
 * Component that renders the attributes of a product in the cart.
 */
function CartProductCardAttributes(props: TProps) {
  const [form, setForm] = useState<{ [x: string]: string }>(props.options)

  useEffect(() => {
    setForm(props.options)
  }, [props.options])

  /**
   * Generates form settings for product attributes using the data from `getProductQueryResult`.
   */
  const generateSettings = useMemo((): TFormSettings<{
    [x: string]: string
  }>[] => {
    // Map product attributes into form settings.
    return props.attributes.product.attributes.map((o) => {
      return {
        inputProps: {
          type: o.type === 'swatch' ? 'color' : 'switch',
          label: o.name,
          readonly: true,
          values: o.items.map((i) => {
            return {
              id: i.id,
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

    return [] // Return an empty array if there's no data.
  }, [props.attributes])

  return (
    <Form updateForm={console.log} form={form} settings={generateSettings} />
  )
}

export default CartProductCardAttributes
