import { useQuery } from '@apollo/client'
import { Suspense, useEffect } from 'react'
import { Outlet, useParams } from 'react-router'

import Header from '../components/Header/Header'
import Page from '../components/Page/Page'
import Cart from '../features/Cart/components/Cart'
import { useCart } from '../features/Cart/providers/CartProvider.'
import {
  GET_PRODUCT_CATEGORIES,
  TGetProductCategoriesResult,
} from '../features/Product/graphql/GetProductCategoriesQuery'
import IProductCategory from '../features/Product/models/IProductCategory'
import { useNavigationContext } from '../providers/NavigationProvider'

/**
 * MainLayout component that serves as the main layout for the application.
 * It fetches categories, handles navigation, and displays the header, cart modal, and page content.
 */
export default function MainLayout() {
  const { category } = useParams()
  const { navigate } = useNavigationContext()
  const cart = useCart()
  const getProductCategoriesState = useQuery<TGetProductCategoriesResult>(
    GET_PRODUCT_CATEGORIES,
  )

  const categories = getProductCategoriesState.data?.categories

  useEffect(() => {
    if (
      categories &&
      !getProductCategoriesState.loading &&
      !categories.some((c: IProductCategory) => c.name === category)
    ) {
      navigate(`/${categories[0].name}`)
    }
  }, [getProductCategoriesState.loading, category, categories, navigate])

  /**
   * Handles the selection of an item and navigates to the corresponding category page.
   *
   * @param item - The selected item as a string.
   */
  const onSelect = (item: string) => {
    navigate(`/${item.toLowerCase()}`)
  }

  const toggleModel = () => {
    cart.isModalVisible ? cart.closeModal() : cart.openModal()
  }

  return (
    <div style={{ height: '100vh' }} className="d-flex flex-column ">
      <div className="container-xxl d-flex flex-column px-0">
        {/** Page header */}
        {!getProductCategoriesState.loading &&
          getProductCategoriesState.data && (
            <Header>
              <Header.Nav
                onSelect={onSelect}
                selected={
                  category ?? getProductCategoriesState.data.categories[0].name
                }
                items={getProductCategoriesState.data.categories.map(
                  (c: any) => c.name,
                )}
                aria-label="Category Navigation"
              />
              <Header.Logo />
              <Header.CartButton onClick={toggleModel} aria-label="Open Cart" />
            </Header>
          )}
      </div>

      <div className=" overflow-y-auto pb-5">
        <Cart aria-label="Cart Modal" />
        <div className="container-xxl d-flex flex-column px-0">
          {/** Page body */}
          <div className="flex-grow-1">
            <div className="row px-2 px-md-4 py-3 py-lg-7 m-0 position-relative">
              <Suspense fallback={<div>Loading...</div>}>
                <Page aria-label="Page Content">
                  <Outlet />
                </Page>
              </Suspense>
            </div>
          </div>
        </div>
      </div>
    </div>
  )
}
