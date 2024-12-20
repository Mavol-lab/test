import InputProvider from '../Inputs/InputBase/InputProvider'
import InputSwitch, {
  TInputSwitchProps,
} from '../Inputs/InputSwitch/InputSwitch'

export type TInputProps = TInputSwitchProps

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
