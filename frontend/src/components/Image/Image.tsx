import classNames from 'classnames'
import { useState } from 'react'

import { TPropsWithStyle } from '../../types/TPropsWith'

type TProps = TPropsWithStyle & {
  src: string
  alt: string
  width?: number
  height?: number
  onClick?: () => void
}

function Image(props: TProps) {
  const [isLoaded, setIsLoaded] = useState(false)

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
      />
    </>
  )
}

export default Image
