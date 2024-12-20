import classNames from 'classnames'
import { useMemo } from 'react'

import { TPropsWithStyle } from '../../types/TPropsWith'
import { deepClone } from '../../utils/deepObjectEqual'
import GenerateInput, { TInputProps } from './GenerateInput'

export type TFormSettings<T> = {
  inputProps: TInputProps
  key: keyof T
  hidden?: boolean
}

type TProps<T extends object> = TPropsWithStyle & {
  /**
   * The form.
   */
  form: T

  /**
   * Function to update the form.
   * @param form - The form.
   */
  updateForm: (form: T) => void

  /**
   * The form settings list.
   */
  settings: TFormSettings<T>[]
}

function Form<T extends Record<string, any>>(props: TProps<T>) {
  const form = useMemo(() => {
    const inputs: JSX.Element[] = []

    props.settings.forEach((settings) => {
      if (settings.key === undefined) {
        return console.warn(settings, 'This object should have the selector.')
      }

      if (settings.hidden) {
        return
      }

      let value = props.form[settings.key]

      inputs.push(
        GenerateInput<T[keyof T]>(settings.inputProps, value, (v: T) => {
          const draftForm = deepClone(props.form) as T

          draftForm[settings.key] = v as T[keyof T]

          props.updateForm(draftForm)
        }),
      )
    })

    return inputs
  }, [props.settings])

  return (
    <form>
      <div
        className={classNames(props.className, 'd-flex flex-column')}
        style={props.style}
      >
        {form.map((input, index) => (
          <div key={index}>{input}</div>
        ))}
      </div>
    </form>
  )
}

export default Form
