import { JSX } from 'react'

import InputProvider from '../Inputs/InputBase/InputProvider'
import InputSwitch, {
  TInputSwitchProps,
} from '../Inputs/InputSwitch/InputSwitch'

export type TInputProps = TInputSwitchProps

/**
 * A generic input component generator that renders different input types based on the provided `inputProps`.
 *
 * @returns {JSX.Element} The generated input component wrapped in an `InputProvider`.
 */
export default function GenerateInput<T>(
  inputProps: TInputProps,
  value: T,
  onChange: (value: T) => void,
): JSX.Element {
  let input = <></>

  switch (inputProps.type) {
    case 'switch':
    case 'color':
      input = <InputSwitch {...inputProps} />
      break
  }

  return <InputProvider<T> {...{ onChange, value }}>{input}</InputProvider>
}
