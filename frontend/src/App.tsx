import './scss/global.scss'

import {
  ApolloClient,
  ApolloProvider,
  HttpLink,
  InMemoryCache,
} from '@apollo/client'
import { BrowserRouter } from 'react-router'

import { CartProvider } from './features/Cart/providers/CartProvider.'
import { NavigationProvider } from './providers/NavigationProvider'
import { AppRoutes } from './routes'

const client = new ApolloClient({
  link: new HttpLink({
    uri: 'http://localhost/ProductController',
  }),
  cache: new InMemoryCache(),
})

function App() {
  return (
    <ApolloProvider client={client}>
      <BrowserRouter>
        <NavigationProvider>
          <CartProvider>
            <AppRoutes />
          </CartProvider>
        </NavigationProvider>
      </BrowserRouter>
    </ApolloProvider>
  )
}

export default App
