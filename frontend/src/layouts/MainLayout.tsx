import { gql, useQuery } from '@apollo/client'
import { Suspense } from 'react'
import { Outlet, useParams } from 'react-router'

import Header from '../components/Header/Header'
import Page from '../components/Page/Page'
import CartModal from '../features/Cart/components/CartModal'
import { useCart } from '../features/Cart/providers/CartProvider.'
import { useNavigationContext } from '../providers/NavigationProvider'

const GET_CATEGORIES = gql`
  query {
    categories {
      name
    }
  }
`

export default function MainLayout() {
  const { category } = useParams()
  const { loading, error, data } = useQuery(GET_CATEGORIES)
  const { navigate } = useNavigationContext()
  const cart = useCart()

  if (loading) return <p>Loading...</p>
  if (error) return <p>Error: {error.message}</p>

  const onSelect = (item: string) => {
    navigate(`/category/${item.toLowerCase()}`)
  }

  return (
    <div style={{ height: '100vh' }} className="d-flex flex-column ">
      <div className="container-xxl d-flex flex-column px-0">
        {/** Page header */}
        <Header>
          <Header.Nav
            onSelect={onSelect}
            selected={category ?? data.categories[0].name}
            items={data.categories.map((c: any) => c.name)}
          />
          <Header.Logo />
          <Header.CartButton onClick={cart.openModal} />
        </Header>
      </div>

      <div className=" overflow-y-auto pb-5">
        <CartModal />
        <div className="container-xxl d-flex flex-column px-0">
          {/** Page body */}
          <div className="flex-grow-1">
            <div className="row px-md-4 py-sm-3 py-lg-7 m-0 position-relative">
              <Suspense fallback={<div>Loading...</div>}>
                <Page>
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
