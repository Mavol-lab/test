import { useRoutes } from 'react-router'

import { publicRoutes } from './routes'

/**
 * AppRoutes component that uses the `useRoutes` hook to render the appropriate route
 * based on the provided `publicRoutes` array.
 */
export const AppRoutes = () => {
  const element = useRoutes([...publicRoutes])

  return element
}
