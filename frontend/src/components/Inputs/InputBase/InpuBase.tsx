import classNames from 'classnames'
import React from 'react'

import {
  TPropsWithStyle,
  TPropsWithVisibility,
} from '../../../types/TPropsWith'
import { useInputContext } from './InputProvider'

type TProps = TPropsWithStyle &
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

/**
 * A base component for input fields that provides common styling and context validation.
 */
function InputBase(props: React.PropsWithChildren<TProps>) {
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
      aria-disabled={props.disabled}
      aria-label={props.title}
    >
      {props.children}
    </div>
  )
}

export default InputBase
