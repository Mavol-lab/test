import './InputSwitch.scss'

import classNames from 'classnames'

import InputBase from '../InputBase/InpuBase'
import { useInputContext } from '../InputBase/InputProvider'

/**
 * The select input value type.
 */
export type SwitchOptionValue = {
  /**
   * The unique option identifier.
   */
  id: string

  /**
   * Returns this key when change the input.
   */
  key: number | string

  /**
   * The value name to display in the option list.
   */
  name: string

  /**
   * The variable is added for testing purposes.
   * Required for test data attribute.
   */
  testId?: string
}

export type TInputSwitchProps = {
  /**
   * The input type.
   */
  type: 'switch' | 'color'

  /**
   * The value list for the select input.
   */
  values: SwitchOptionValue[]

  /**
   * The input field label.
   */
  label: string

  /**
   * Enables readonly mode.
   */
  readonly?: boolean

  /**
   * The variable is added for testing purposes.
   * Required for test data attribute.
   */
  testId?: string
}

/**
 * InputSwitch component allows users to switch between multiple input values.
 * It supports keyboard and mouse interactions and can be configured to be readonly.
 */
function InputSwitch(props: TInputSwitchProps) {
  const { setValue, value } = useInputContext<string | number>()

  /**
   * Handles the key down event for the input switch.
   * If the component is not read-only and the Enter or Space key is pressed,
   * it sets the value of the input switch.
   *
   * @param e - The keyboard event.
   * @param value - The value to set when the key is pressed.
   */
  const onKeyDown = (e: React.KeyboardEvent, value: string | number) => {
    if (!props.readonly && (e.key === 'Enter' || e.key === ' ')) {
      setValue(value)
    }
  }

  /**
   * Handles the click event for the input switch.
   * If the component is not in readonly mode, it updates the value.
   *
   * @param value - The new value to set, which can be a string or a number.
   */
  const onClick = (value: string | number) => {
    if (!props.readonly) {
      setValue(value)
    }
  }

  return (
    <div
      className={classNames([
        { readonly: props.readonly },
        'input-switch',
        props.type,
      ])}
      role="group"
      aria-labelledby="input-switch-label"
    >
      <span
        id="input-switch-label"
        className={classNames([
          { 'fs-6 fw-bold text-uppercase': !props.readonly },
          { 'fs-7': props.readonly },
        ])}
      >
        {props.label}:
      </span>
      <InputBase title="">
        <ul
          data-testid={props.testId}
          className={classNames([
            'd-flex py-1 px-0 flex-wrap',
            { 'gap-3': !props.readonly },
            { 'gap-2 m-0': props.readonly },
          ])}
          role="listbox"
          aria-readonly={props.readonly}
        >
          {props.values?.map((p, i) => (
            <li
              tabIndex={0}
              className={classNames([
                'item',
                { 'p-2': !props.readonly },
                { 'fs-7 p-1': props.readonly },
                { selected: value === p.id },
              ])}
              style={{
                backgroundColor:
                  props.type === 'color' ? (p.key as string) : '',
              }}
              onKeyDown={(e) => onKeyDown(e, p.id)}
              onClick={() => onClick(p.id)}
              key={i}
              title={p.name}
              aria-checked={value === p.id}
              role="option"
              data-testid={
                p.testId
                  ? `${p.testId}${value === p.id ? '-selected' : ''}`
                  : ''
              }
            >
              {props.type !== 'color' && p.name}
            </li>
          ))}
        </ul>
      </InputBase>
    </div>
  )
}

export default InputSwitch
