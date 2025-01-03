import classNames from 'classnames'
import { useState } from 'react'

import { TPropsWithStyle } from '../../types/TPropsWith'

type TProps = TPropsWithStyle & {
  /**
   * The source URL of the image.
   */
  src: string

  /**
   * The alt text for the image.
   */
  alt: string

  /**
   * The width of the image.
   */
  width?: number

  /**
   * The height of the image.
   */
  height?: number

  /**
   * Optional click handler for the image.
   */
  onClick?: () => void
}

/**
 * Image component that displays an image with a loading placeholder.
 */
function Image(props: TProps) {
  const [isLoaded, setIsLoaded] = useState(false)

  /**
   * Handles the click event on the image component.
   * If a click handler is provided via props, it will be called.
   */
  const onClick = () => {
    if (props.onClick) {
      props.onClick()
    }
  }

  return (
    <>
      {!isLoaded && (
        <div
          className="bg-secondary"
          style={{ width: props.width, height: props.height }}
          aria-hidden="true"
        ></div>
      )}

      <img
        width={props.width}
        height={props.height}
        src={props.src}
        alt={props.alt}
        className={classNames([
          'cursor-pointer',
          { 'visually-hidden': !isLoaded },
        ])}
        onClick={() => onClick()}
        onLoad={() => setIsLoaded(true)}
        aria-busy={!isLoaded}
      />
    </>
  )
}

export default Image
