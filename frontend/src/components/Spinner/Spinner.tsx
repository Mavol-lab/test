import './Spinner.scss'

import classNames from 'classnames'

import { TPropsWithStyle } from '../../types/TPropsWith'

type TProps = TPropsWithStyle & {
  width?: number
}

function Spinner(props: TProps) {
  return (
    <div
      style={{ width: props.width }}
      className={classNames('loader', props.className)}
    ></div>
  )
}

export default Spinner
