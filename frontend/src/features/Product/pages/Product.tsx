import { gql, useQuery } from '@apollo/client'
import parse from 'html-react-parser'
import { useEffect, useMemo, useState } from 'react'
import { useParams } from 'react-router'

import Button from '../../../components/Button/Button'
import ButtonColor from '../../../components/Button/types/ButtonColor'
import ButtonType from '../../../components/Button/types/ButtonType'
import Form, { TFormSettings } from '../../../components/Form/Form'
import Spinner from '../../../components/Spinner/Spinner'
import Breakpoint from '../../../enums/Breakpoint'
import useWindowSize from '../../../hooks/useWindowSize'
import { toKebabCase } from '../../../utils/textFormat'
import { useCart } from '../../Cart/providers/CartProvider.'
import ProductCarousel from '../components/Carousel/ProductCarousel'
import IProduct from '../models/IProduct'

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

export default function Product() {
  const [form, setForm] = useState<{ [x: string]: string }>({})

  const { product } = useParams<{ product: string }>()
  const cart = useCart()

  const { loading, error, data } = useQuery<{ product: IProduct }>(
    GET_PRODUCT,
    {
      variables: { id: product },
    },
  )

  const { reachBreakpoint } = useWindowSize()

  const price = data?.product.prices[0]

  /**
   * Populate the form state with default values when data is fetched.
   */
  useEffect(() => {
    if (data) {
      // Reduce attributes into an object with keys as attribute IDs and empty strings as default values.
      const newForm = data.product.attributes.reduce(
        (acc, a) => {
          acc[a.id] = '' // Initialize each attribute.
          return acc
        },
        {} as { [x: string]: string },
      )

      setForm(newForm)
    }
  }, [data])

  const formIsValid = useMemo(() => {
    return !Object.values(form).some((v) => !v)
  }, [form])

  /**
   * Function to generate form settings for the builder.
   */
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
            values: o.items.map((i) => {
              return {
                key: i.value,
                name: i.displayValue,
              }
            }),
            testId: `product-attribute-${toKebabCase(o.name)}`,
          },
          key: o.id,
        }
      })
    }

    return [] // Return an empty array if there's no data.
  }, [form])

  /**
   * Function to add an item to cart.
   */
  const addToCart = async () => {
    if (!data) {
      return
    }

    // Throttling
    await new Promise((resolve) => {
      setTimeout(() => {
        resolve(null)
      }, 1000)
    })

    await cart.addToCart({
      productId: data?.product.id,
      options: form,
      quantity: 1,
      price: data.product.prices,
    })

    cart.openModal()
  }

  if (loading) {
    return (
      <div className="">
        <Spinner className="primary m-auto" width={50} />
      </div>
    )
  }

  return (
    <div className="d-flex flex-column align-items-lg-start flex-lg-row gap-7 flex-grow-1">
      {data && (
        <ProductCarousel src={data.product.gallery.map((g) => g.imageUrl)} />
      )}

      <div
        className="d-flex flex-column gap-5 pe-lg-7"
        style={{ maxWidth: reachBreakpoint(Breakpoint.LG) ? 300 : '100%' }}
      >
        <h2>{data?.product.name}</h2>
        {form && data?.product.inStock && (
          <Form updateForm={setForm} form={form} settings={generateSettings} />
        )}
        <div>
          <div className="fs-6 fw-bold text-uppercase">Price:</div>
          <div className="fs-5 fw-bold text-uppercase">
            <span title={price?.currency.label}>{price?.currency.symbol}</span>
            <span>{price?.amount.toFixed(2)}</span>
          </div>
        </div>
        <Button
          className="p-3 w-100"
          color={ButtonColor.Primary}
          type={ButtonType.Solid}
          isDisabled={!data?.product.inStock || !formIsValid}
          onClick={addToCart}
          testId="add-to-cart"
        >
          <span className="text-uppercase">
            {data?.product.inStock ? 'Add to cart' : 'Out of stock'}
          </span>
        </Button>
        <div>
          <div data-testid="product-description">
            {parse(data?.product.description ?? '')}
          </div>
        </div>
      </div>
    </div>
  )
}
