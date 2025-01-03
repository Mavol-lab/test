import './Header.scss'

import { PropsWithChildren } from 'react'

import HeaderCartButton from './HeaderCartButton'
import HeaderLogo from './HeaderLogo'
import HeaderNav from './HeaderNav'

type TProps = PropsWithChildren

/**
 * Header component that renders a header element with specified classes and children.
 */
function Header(props: TProps) {
  return (
    <header
      className="row px-2 px-md-5 mt-2 mt-md-3 m-0 header bg-negative"
      aria-label="Main Header"
    >
      {props.children}
    </header>
  )
}

/**
 * Enhances the `Header` component by attaching additional subcomponents.
 */
export default Object.assign(Header, {
  Nav: HeaderNav,
  Logo: HeaderLogo,
  CartButton: HeaderCartButton,
})
