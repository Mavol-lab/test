import { Navigate } from 'react-router'

import Catalog from '../features/Catalog/pages/Catalog'
import Product from '../features/Product/pages/Product'
import MainLayout from '../layouts/MainLayout'
import Redirect from './Redirect'

export const publicRoutes = [
  {
    caseSensitive: false,
    path: '/',
    element: <MainLayout />,
    children: [
      {
        index: true,
        element: <Navigate to="/category/all" replace />,
      },
      {
        path: '/category/:category',
        element: <Catalog />,
      },
      {
        path: '/category/:category/product/:product',
        element: <Product />,
      },
    ],
  },
  {
    path: '*',
    element: <Redirect />,
  },
]
