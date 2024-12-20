import './InputSwitch.scss'

import classNames from 'classnames'

import { toKebabCase } from '../../../utils/textFormat'
import InputBase from '../InputBase/InpuBase'
import { useInputContext } from '../InputBase/InputProvider'

/**
 * The select input value type.
 */
export type SwitchOptionValue = {
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
   * Enables modal mode.
   */
  modal?: boolean

  /**
   * The variable is added for testing purposes.
   * Required for test data attribute.
   */
  testId?: string
}

function InputSwitch(props: TInputSwitchProps) {
  const { setValue, value } = useInputContext<string | number>()

  const onKeyDown = (e: React.KeyboardEvent, value: string | number) => {
    if (!props.readonly && (e.key === 'Enter' || e.key === ' ')) {
      setValue(value)
    }
  }

  const onClick = (value: string | number) => {
    if (!props.readonly) {
      setValue(value)
    }
  }

  return (
    <div
      className={classNames([
        { modal: props.modal },
        'input-switch',
        props.type,
      ])}
    >
      <span
        className={classNames([
          { 'fs-6 fw-bold text-uppercase': !props.modal },
          { 'fs-7': props.modal },
        ])}
      >
        {props.label}:
      </span>
      <InputBase title="">
        <ul
          data-testid={props.testId}
          className={classNames([
            'd-flex py-1 px-0 flex-wrap',
            { 'gap-3': !props.modal },
            { 'gap-2 m-0': props.modal },
          ])}
        >
          {props.values?.map((p, i) => (
            <li
              tabIndex={0}
              className={classNames([
                'item',
                { 'p-2': !props.modal },
                { 'fs-7 p-1': props.modal },
                { selected: value === p.key },
              ])}
              style={{
                backgroundColor:
                  props.type === 'color' ? (p.key as string) : '',
              }}
              onKeyDown={(e) => onKeyDown(e, p.key)}
              onClick={() => onClick(p.key)}
              key={i}
              title={p.name}
              aria-checked={value === p.key}
              data-testid={
                p.testId
                  ? `${p.testId}${value === p.key ? '-selected' : ''}`
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
