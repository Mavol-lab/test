import classNames from 'classnames'

import {
  TPropsWithStyle,
  TPropsWithVisibility,
} from '../../../types/TPropsWith'
import { useInputContext } from './InputProvider'

type TProps<T> = TPropsWithStyle &
  TPropsWithVisibility & {
    /**
     * The input title.
     */
    title: string

    /**
     * Disables the input component when true.
     */
    disabled?: boolean

    /**
     * When enabled, hides the error message.
     */
    hideError?: boolean
  }

function InputBase<T>(props: React.PropsWithChildren<TProps<T>>) {
  const context = useInputContext<string>()

  if (props.isVisible === false) {
    return null
  }

  if (!context) {
    console.error('Each input field must have input provider.')
  }

  return (
    <div
      className={classNames(
        'input-group has-validation w-100',
        { 'opacity-75': props.disabled },
        props.className,
      )}
      style={props.style}
      title={props.title}
    >
      {props.children}
    </div>
  )
}

export default InputBase
