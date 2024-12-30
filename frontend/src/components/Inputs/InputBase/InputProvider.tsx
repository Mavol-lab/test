import { ChangeEvent, createContext, useContext } from 'react'

/**
 * The context for input based components.
 */
export type TInputContext<T> = {
  /**
   * Function to call when the value of the input changes.
   * @param event - The input change event.
   */
  onChange: (
    event: ChangeEvent<
      HTMLInputElement | HTMLTextAreaElement | HTMLSelectElement
    >,
  ) => void

  setValue: (value: T) => void

  /**
   * The current value of the input.
   */
  value: T
}

type TProps<T> = {
  /**
   * The current value of the input.
   */
  value: T

  /**
   * Function to call when the value of the input changes.
   * @param value - The new value of the input.
   */
  onChange: (value: T) => void
}

/**
 * The input context for input based components.
 */
const InputContext = createContext<TInputContext<unknown> | undefined>(
  undefined,
)

export default function InputProvider<T>(
  props: React.PropsWithChildren<TProps<T>>,
) {
  /**
   * Function to call when the value of the input changes.
   * @param event - The input change event.
   */
  const onChange = (
    event: ChangeEvent<
      HTMLInputElement | HTMLTextAreaElement | HTMLSelectElement
    >,
  ) => {
    const target = event.currentTarget as HTMLInputElement

    // The value should be converted bcause it is string by default
    switch (target.type) {
      case 'select-one':
        props.onChange(Number(target.value) as T)
        break
      case 'checkbox':
        props.onChange(target.checked as T)
        break
      case 'number':
        props.onChange(Number(target.value) as T)
        break
      default:
        props.onChange(target.value as T)
    }
  }

  /**
   * The method allows you to set the value directly without using an event.
   * Useful, for example, for switch input fields.
   * @param value - The new input value.
   */
  const setValue = (value: any) => {
    props.onChange(value)
  }

  return (
    <InputContext
      value={{
        onChange,
        setValue,
        value: props.value,
      }}
    >
      {props.children}
    </InputContext>
  )
}

export const useInputContext = <T,>() => {
  const context = useContext(InputContext as React.Context<TInputContext<T>>)

  if (!context) {
    throw 'useInputContext should be used in pair with the input base component.'
  }

  return context
}
