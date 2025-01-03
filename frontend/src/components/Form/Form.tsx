import classNames from 'classnames'
import { JSX, useMemo } from 'react'

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

/**
 * A generic form component that dynamically generates input fields based on the provided settings.
 */
function Form<T extends Record<string, any>>(props: TProps<T>) {
  const { settings, form, updateForm } = props

  const inputs = useMemo(() => {
    const inputs: JSX.Element[] = []

    settings.forEach((settings) => {
      if (settings.key === undefined) {
        return console.warn(settings, 'This object should have the selector.')
      }

      if (settings.hidden) {
        return
      }

      let value = form[settings.key]

      inputs.push(
        GenerateInput<T[keyof T]>(settings.inputProps, value, (v: T) => {
          const draftForm = deepClone(form) as T

          draftForm[settings.key] = v as T[keyof T]

          updateForm(draftForm)
        }),
      )
    })

    return inputs
  }, [settings, form, updateForm])

  return (
    <form aria-label="dynamic-form">
      <div
        className={classNames(props.className, 'd-flex flex-column')}
        style={props.style}
      >
        {inputs.map((input, index) => (
          <div key={index} aria-labelledby={`input-${index}`}>
            {input}
          </div>
        ))}
      </div>
    </form>
  )
}

export default Form
