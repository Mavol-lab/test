import { createContext, useContext, useEffect, useMemo, useState } from 'react'

import { deepClone, deepEqual } from '../../../utils/deepObjectEqual'
import IndexedDBService from '../../../utils/indexedDBService'
import IProductPrice from '../../Product/models/IProductPrice'

type TCartItem = {
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

  /**
   * The product price per item.
   */
  price: IProductPrice[]
}

type TCartContextType = {
  /**
   * The list of items in the cart.
   */
  cart: TCartItem[]

  /**
   * Function to add an item to the cart.
   */
  addToCart: (item: Partial<TCartItem>) => Promise<void>

  /**
   * Function to remove an item from the cart based on its id.
   */
  removeFromCart: (id: number) => void

  /**
   * Function to clear all items from the cart.
   */
  clearCart: () => Promise<void>

  /**
   * Retrieves total cart price.
   */
  calculateTotal: () => number

  /**
   * Retrieves item count.
   */
  itemCount: () => number

  /**
   * True when cart is visible.
   */
  isModalVisible: boolean

  /**
   * Function to open the cart.
   */
  openModal: () => void

  /**
   * Function to close the cart.
   */
  closeModal: () => void
}

const CartContext = createContext<TCartContextType | undefined>(undefined)

/**
 * Custom hook to access the Cart context.
 *
 * This hook provides access to the Cart context, allowing components to
 * interact with the cart state and actions. It must be used within a
 * `CartProvider` to ensure the context is available.
 *
 * @throws {Error} If the hook is used outside of a `CartProvider`.
 *
 * @returns {TCartContextType} The current context value for the cart.
 */
export const useCart = () => {
  const context = useContext(CartContext)
  if (!context) {
    throw new Error('useCart must be used within a CartProvider')
  }
  return context
}

/**
 * CartProvider component that provides cart-related functionalities and state management.
 */
export const CartProvider: React.FC<{ children: React.ReactNode }> = ({
  children,
}) => {
  const [cart, setCart] = useState<TCartItem[]>([])
  const [isModalVisible, setIsModalVisible] = useState(false)

  const cartDB = useMemo(
    () => new IndexedDBService<TCartItem>('ShoppingCartDB', 'cart'),
    [],
  )

  useEffect(() => {
    const loadCart = async () => {
      const items = await cartDB.getAllItems()

      setCart(items)
    }

    loadCart()
  }, [cartDB])

  /**
   * Function to add an item to the cart.
   */
  const addToCart = async (item: Partial<TCartItem>): Promise<void> => {
    if (!item.productId || !item.quantity || !item.price || !item.options) {
      throw new Error('Missing required fields in cart item')
    }

    const existingItem = deepClone(
      cart.find(
        (cartItem) =>
          cartItem.productId === item.productId &&
          deepEqual(cartItem.options, item.options),
      ),
    )

    if (existingItem) {
      // If the item exists, update the quantity
      existingItem.quantity += item.quantity

      setCart((old) =>
        old.map((o) => {
          if (o.id === existingItem.id) {
            return existingItem
          }

          return o
        }),
      )

      return await cartDB.addItem(existingItem)
    }

    const newItem: TCartItem = {
      id: cart.length,
      productId: item.productId,
      quantity: item.quantity,
      options: item.options || {},
      price: item.price,
    }

    // If the item is new, add it to the cart
    setCart((prev) => [...prev, newItem])
    return await cartDB.addItem(newItem)
  }

  const calculateTotal = (): number => {
    let t = cart.reduce((total, item) => {
      return total + item.price[0]?.amount * item.quantity
    }, 0)

    if (isNaN(t)) {
      t = 10
    }

    return t
  }

  const itemCount = (): number => {
    return cart.reduce((total, item) => {
      return total + item.quantity
    }, 0)
  }

  /**
   * Function to remove an item from the cart by its id.
   */
  const removeFromCart = async (id: number): Promise<void> => {
    const existingItem = deepClone(cart.find((cartItem) => cartItem.id === id))

    if (existingItem && existingItem.quantity > 1) {
      // Update the quantity
      existingItem.quantity -= 1

      setCart((old) =>
        old.map((o) => {
          if (o.id === existingItem.id) {
            return existingItem
          }

          return o
        }),
      )

      return await cartDB.addItem(existingItem)
    } else if (existingItem) {
      setCart((prev) => prev.filter((p) => p.id !== id))

      await cartDB.removeItem(id)
    }
  }

  /**
   * Function to open the cart.
   */
  const openModal = (): void => {
    setIsModalVisible(true)
  }

  /**
   * Function to close the cart.
   */
  const closeModal = (): void => {
    setIsModalVisible(false)
  }

  /**
   * Function to clear all items from the cart.
   */
  const clearCart = async (): Promise<void> => {
    setCart([])
    await cartDB.clearStore()
  }

  return (
    <CartContext
      value={{
        cart,
        addToCart,
        removeFromCart,
        clearCart,
        calculateTotal,
        itemCount,
        isModalVisible,
        closeModal,
        openModal,
      }}
    >
      {children}
    </CartContext>
  )
}
