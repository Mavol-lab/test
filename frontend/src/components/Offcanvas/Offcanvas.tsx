import './Offcanvas.scss'

import classNames from 'classnames'
import { PropsWithChildren } from 'react'
import { createPortal } from 'react-dom'

import Button from '../Button/Button'
import ButtonColor from '../Button/types/ButtonColor'
import ButtonType from '../Button/types/ButtonType'

type TProps = PropsWithChildren & {
  /**
   * The canvas is visible when true.
   */
  visible: boolean

  /**
   * Function to call when offcanvas is closing.
   */
  onClose: () => void
  name: string
}

function Offcanvas(props: TProps) {
  return createPortal(
    <>
      <div
        className={classNames([
          'position-fixed bg-white top-0 start-0 p-3 h-100 z-2 offcanvas',
          { visible: props.visible },
        ])}
      >
        <div className="d-flex justify-content-between align-items-center mb-4">
          <h3 className="m-0">{props.name}</h3>
          <Button
            className="ms-6"
            color={ButtonColor.Primary}
            type={ButtonType.Transparent}
            onClick={props.onClose}
          >
            <i className="icon icon-close" />
          </Button>
        </div>
        {props.children}
      </div>
      <div
        className={classNames(
          'position-fixed top-0 start-0 w-100 h-100 z-1 curtain',
          { visible: props.visible },
        )}
        onClick={props.onClose}
      ></div>
    </>,
    document.body,
  )
}

export default Offcanvas
