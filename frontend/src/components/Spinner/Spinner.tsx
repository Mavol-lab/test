import './Spinner.scss'

import classNames from 'classnames'

import { TPropsWithStyle } from '../../types/TPropsWith'

type TProps = TPropsWithStyle

function Spinner(props: TProps) {
  return <div className={classNames('loader', props.className)}></div>
}

export default Spinner
