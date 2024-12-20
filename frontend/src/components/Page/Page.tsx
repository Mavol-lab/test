import './Page.scss'

import classNames from 'classnames'
import { PropsWithChildren } from 'react'

import { useNavigationContext } from '../../providers/NavigationProvider'

type TProps = PropsWithChildren & {}

function Page(props: TProps) {
  const navigation = useNavigationContext()

  return (
    <div className={classNames('page', navigation.animationState)}>
      {props.children}
    </div>
  )
}

export default Page
