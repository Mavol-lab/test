import './Header.scss'

import { PropsWithChildren } from 'react'

import HeaderCartButton from './HeaderCartButton'
import HeaderLogo from './HeaderLogo'
import HeaderNav from './HeaderNav'

type TProps = PropsWithChildren

function Header(props: TProps) {
  return (
    <header className="row px-2 px-md-5 pt-4 m-0 header">
      {props.children}
    </header>
  )
}

export default Object.assign(Header, {
  Nav: HeaderNav,
  Logo: HeaderLogo,
  CartButton: HeaderCartButton,
})
