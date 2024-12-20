import { CSSProperties, ReactNode } from 'react'

export type TPropsWithStyle = {
  /**
   * The component style class name list.
   */
  className?: string

  /**
   * The component style list.
   */
  style?: CSSProperties
}

// Like PropsWithChildren but children is required
export type TPropsWithChildren = {
  /**
   * The component children render fragment.
   */
  children: ReactNode
}

export type TPropsWithVisibility = {
  /**
   * The component style class name list.
   */
  isVisible?: boolean

  /**
   * Function to call when component is hiding.
   */
  onHide?: () => void
}
