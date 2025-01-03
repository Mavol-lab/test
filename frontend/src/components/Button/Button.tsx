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
  onClick?: (e: React.MouseEvent) => Promise<void> | void

  /**
   * The variable is added for testing purposes.
   * Required for test data attribute.
   */
  testId?: string
}

/**
 * Button component that renders a button element with loading state and custom styles.
 */
function Button(props: TProps) {
  const [isLoading, setIsLoading] = useState(false)

  /**
   * Handles the button click event.
   * If the button is not disabled and an onClick handler is provided via props,
   * it sets the loading state to true, awaits the execution of the onClick handler,
   * and then sets the loading state back to false.
   *
   * @async
   * @function
   * @returns {Promise<void>} A promise that resolves when the onClick handler completes.
   */
  const onClick = async (e: React.MouseEvent): Promise<void> => {
    if (props.onClick && !props.isDisabled) {
      setIsLoading(true)
      await props.onClick(e)
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
      aria-disabled={props.isDisabled || isLoading}
      aria-busy={isLoading}
    >
      {props.children}
      <Spinner className={classNames({ 'd-none': !isLoading })} />
    </button>
  )
}

export default Button
