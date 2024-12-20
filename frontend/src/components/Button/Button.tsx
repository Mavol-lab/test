import './Button.scss'

import classNames from 'classnames'
import { PropsWithChildren, useState } from 'react'

import Spinner from '../Spinner/Spinner'
import ButtonColor from './types/ButtonColor'
import ButtonType from './types/ButtonType'

type TProps = PropsWithChildren & {
  /**
   * The button type.
   */
  type: ButtonType

  /**
   * The button color.
   */
  color: ButtonColor

  /**
   * The button class name list.
   */
  className?: string

  /**
   * The button is disabled when true.
   */
  isDisabled?: boolean

  /**
   * Function to call when button is clicked.
   */
  onClick?: () => Promise<void> | void

  /**
   * The variable is added for testing purposes.
   * Required for test data attribute.
   */
  testId?: string
}

function Button(props: TProps) {
  const [isLoading, setIsLoading] = useState(false)

  const onClick = async () => {
    if (props.onClick && !props.isDisabled) {
      setIsLoading(true)
      await props.onClick()
      setIsLoading(false)
    }
  }

  return (
    <button
      type="button"
      className={classNames([
        props.className,
        'btn d-flex gap-4 align-items-center justify-content-center',
        props.color,
        props.type,
        { disabled: props.isDisabled || isLoading },
      ])}
      onClick={onClick}
      data-testid={props.testId}
    >
      {props.children}
      <Spinner className={classNames({ 'd-none': !isLoading })} />
    </button>
  )
}

export default Button
