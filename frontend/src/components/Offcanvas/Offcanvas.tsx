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

/**
 * Offcanvas component renders a sidebar that slides in from the left side of the screen.
 * It uses React Portal to render the component outside the DOM hierarchy of the parent component.
 */
function Offcanvas(props: TProps) {
  return createPortal(
    <>
      <div
        className={classNames([
          'position-fixed bg-white top-0 start-0 p-3 h-100 z-2 offcanvas',
          { visible: props.visible },
        ])}
        role="dialog"
        aria-modal="true"
        aria-labelledby="offcanvas-title"
      >
        <div className="d-flex justify-content-between align-items-center mb-4">
          <h3 id="offcanvas-title" className="m-0">
            {props.name}
          </h3>
          <Button
            className="ms-6"
            color={ButtonColor.Primary}
            type={ButtonType.Transparent}
            onClick={props.onClose}
            aria-label="Close"
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
        aria-hidden="true"
      ></div>
    </>,
    document.body,
  )
}

export default Offcanvas
