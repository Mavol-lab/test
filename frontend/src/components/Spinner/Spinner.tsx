import './Spinner.scss'

import classNames from 'classnames'

import { TPropsWithStyle } from '../../types/TPropsWith'

type TProps = TPropsWithStyle & {
  /**
   * The width of the spinner.
   */
  width?: number
}

/**
 * Spinner component renders a loading spinner with customizable width and additional class names.
 */
function Spinner(props: TProps) {
  return (
    <div
      style={{ width: props.width }}
      className={classNames('loader', props.className)}
      role="status"
      aria-live="polite"
      aria-busy="true"
    ></div>
  )
}

export default Spinner
