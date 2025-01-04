import { useQuery } from '@apollo/client'
import parse from 'html-react-parser'
import { useEffect, useMemo, useState } from 'react'
import { useParams } from 'react-router'

import Button from '../../../components/Button/Button'
import ButtonColor from '../../../components/Button/types/ButtonColor'
import ButtonType from '../../../components/Button/types/ButtonType'
import Breakpoint from '../../../enums/Breakpoint'
import useWindowSize from '../../../hooks/useWindowSize'
import { useCart } from '../../Cart/providers/CartProvider.'
import ProductCarousel from '../components/Carousel/ProductCarousel'
import ProductAttributes from '../components/ProductAttributes'
import ProductPlaceholder from '../components/ProductPlaceholder'
import {
  GET_PRODUCT,
  TGetProductQuery,
  TGetProductResult,
} from '../graphql/GetProductQuery'

/**
 * The `Product` component is responsible for displaying the details of a single product.
 * It fetches product data using a GraphQL query, manages form state for product attributes,
 * and allows users to add the product to their cart.
 */
export default function Product() {
  const [form, setForm] = useState<{ [x: string]: string }>({})
  const { reachBreakpoint } = useWindowSize()
  const params = useParams<{ product: string }>()
  const cart = useCart()

  const getProductState = useQuery<TGetProductResult, TGetProductQuery>(
    GET_PRODUCT,
    {
      variables: { id: params.product || '' },
      skip: !params.product,
    },
  )

  const product = getProductState.data?.product
  const price = product?.prices[0]

  /**
   * Populate the form state with default values when data is fetched.
   */
  useEffect(() => {
    if (getProductState.data) {
      // Reduce attributes into an object with keys as attribute IDs and empty strings as default values.
      const newForm = getProductState.data.product.attributes.reduce(
        (acc, a) => {
          acc[a.id] = '' // Initialize each attribute.
          return acc
        },
        {} as { [x: string]: string },
      )

      setForm(newForm)
    }
  }, [getProductState.data])

  const formIsValid = useMemo(() => {
    return !Object.values(form).some((v) => !v)
  }, [form])

  if (!product || getProductState.loading) {
    return <ProductPlaceholder />
  }

  /**
   * Function to add an item to cart.
   */
  const addToCart = async () => {
    await cart.addToCart({
      productId: product.id,
      options: form,
      quantity: 1,
      price: product.prices,
    })

    cart.openModal()
  }

  return (
    <div
      className="d-flex flex-column align-items-lg-start flex-lg-row gap-7 flex-grow-1"
      aria-live="polite"
    >
      <ProductCarousel
        src={product.gallery.map((g) => g.imageUrl)}
        aria-label="Product images carousel"
      />

      <div
        className="d-flex flex-column gap-5 pe-lg-7"
        style={{ maxWidth: reachBreakpoint(Breakpoint.LG) ? 300 : '100%' }}
        aria-labelledby="product-name"
      >
        <h2 id="product-name">{product.name}</h2>
        <ProductAttributes
          form={form}
          onUpdateForm={setForm}
          product={product}
        />
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
          isDisabled={!product.inStock || !formIsValid}
          onClick={addToCart}
          testId="add-to-cart"
          aria-label="Add to cart button"
        >
          {product.inStock ? 'ADD TO CART' : 'OUT OF STOCK'}
        </Button>
        <div>
          <div
            data-testid="product-description"
            aria-label="Product description"
          >
            {parse(product.description ?? '')}
          </div>
        </div>
      </div>
    </div>
  )
}
