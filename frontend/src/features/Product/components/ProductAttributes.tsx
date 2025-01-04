import { useMemo } from 'react'

import Form, { TFormSettings } from '../../../components/Form/Form'
import { toKebabCase } from '../../../utils/textFormat'
import IProduct from '../models/IProduct'

type TProps = {
  /**
   * The product object.
   */
  product: IProduct

  /**
   * The form object to be updated.
   */
  form: { [x: string]: string }

  /**
   * Callback function to update the form.
   */
  onUpdateForm: (value: { [x: string]: string }) => void
}

/**
 * Component to render product attributes as a form.
 */
const ProductAttributes = (props: TProps) => {
  /**
   * Function to generate form settings for the builder.
   */
  const generateSettings = useMemo((): TFormSettings<{
    [x: string]: string
  }>[] => {
    // Map product attributes into form settings.
    return props.product.attributes.map((o, i) => {
      return {
        inputProps: {
          type: o.type === 'swatch' ? 'color' : 'switch',
          label: o.name,
          values: o.items.map((i) => {
            return {
              key: i.value,
              id: i.id,
              name: i.displayValue,
              testId: `product-attribute-${toKebabCase(o.name)}-${i.value}`,
            }
          }),
          testId: `product-attribute-${toKebabCase(o.name)}`,
        },
        key: o.id,
      }
    })
  }, [props.product])

  return (
    props.product.inStock && (
      <Form
        updateForm={props.onUpdateForm}
        form={props.form}
        settings={generateSettings}
        aria-label="Product attributes form"
      />
    )
  )
}

export default ProductAttributes
