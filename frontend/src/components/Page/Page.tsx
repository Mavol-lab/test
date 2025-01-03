import './Page.scss'

import classNames from 'classnames'
import { PropsWithChildren } from 'react'

import { useNavigationContext } from '../../providers/NavigationProvider'

type TProps = PropsWithChildren & {}

/**
 * The `Page` component is a wrapper that provides a consistent layout for its children.
 * It utilizes the `useNavigationContext` hook to access the current navigation state
 * and applies the corresponding animation state as a CSS class.
 */
function Page(props: TProps) {
  const navigation = useNavigationContext()

  return (
    <div
      className={classNames('page', navigation.animationState)}
      aria-live="polite"
    >
      {props.children}
    </div>
  )
}

export default Page
