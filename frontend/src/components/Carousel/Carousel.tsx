import './Carousel.scss'

import Button from '../Button/Button'
import ButtonColor from '../Button/types/ButtonColor'
import ButtonType from '../Button/types/ButtonType'

type TProps = {
  /**
   * The current carousel src.
   */
  src: string

  /**
   * Function to call when next control was clicked.
   */
  onNext: () => void

  /**
   * Function to call when previous control was clicked.
   */
  onPrevious: () => void
}

function Carousel(props: TProps) {
  return (
    <div
      className="carousel position-relative w-100 h-100"
      style={{ backgroundImage: `url(${props.src})` }}
    >
      <div className="controls position-absolute w-100 h-100 px-3 d-flex align-items-center justify-content-between">
        <Button
          color={ButtonColor.Secondary}
          type={ButtonType.Solid}
          className="left p-0 d-flex align-items-center"
          onClick={props.onPrevious}
        >
          <i className="icon icon-left bg-white p-4" />
        </Button>
        <Button
          color={ButtonColor.Secondary}
          type={ButtonType.Solid}
          className="right p-0 d-flex align-items-center"
          onClick={props.onNext}
        >
          <i className="icon icon-right bg-white p-4" />
        </Button>
      </div>
    </div>
  )
}

export default Carousel
