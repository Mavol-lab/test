import classNames from 'classnames'
import { useState } from 'react'

import Carousel from '../../../../components/Carousel/Carousel'
import Image from '../../../../components/Image/Image'
import Breakpoint from '../../../../enums/Breakpoint'
import useWindowSize from '../../../../hooks/useWindowSize'

type TProps = {
  src: string[]
}

function ProductCarousel(props: TProps) {
  const [currentImage, setCurrentImage] = useState(props.src[0])
  const { reachBreakpoint } = useWindowSize()

  const handleNext = () => {
    const next = props.src.indexOf(currentImage) + 1

    setCurrentImage(
      next > props.src.length - 1 ? props.src[0] : props.src[next],
    )
  }

  const handlePrevious = () => {
    const prev = props.src.indexOf(currentImage) - 1

    setCurrentImage(
      prev < 0 ? props.src[props.src.length - 1] : props.src[prev],
    )
  }

  function drumRoll<T>(activeIndex: number, array: T[], offset: number): T[] {
    const length = array.length
    const result: T[] = []

    const startIndex = (activeIndex - offset + length) % length
    const endIndex = (activeIndex + offset) % length

    if (startIndex <= endIndex) {
      for (let i = startIndex; i <= endIndex; i++) {
        result.push(array[i % length])
      }
    } else {
      for (let i = startIndex; i < length; i++) {
        result.push(array[i % length])
      }
      for (let i = 0; i <= endIndex; i++) {
        result.push(array[i % length])
      }
    }

    return result
  }

  return (
    <div
      className="d-flex flex-column-reverse flex-lg-row gap-5 align-items-center flex-grow-1"
      data-testid="product-gallery"
    >
      <div className="d-flex flex-row flex-lg-column gap-2">
        {drumRoll(
          props.src.indexOf(currentImage),
          props.src,
          reachBreakpoint(Breakpoint.MD) ? 2 : 1,
        ).map((image, index) => (
          <div
            key={index}
            className={classNames([
              { 'shadow border border-primary': currentImage === image },
            ])}
          >
            <Image
              width={80}
              height={80}
              alt={`Thumbnail ${index}`}
              src={image}
              onClick={() => setCurrentImage(image)}
            />
          </div>
        ))}
      </div>

      <Carousel
        src={currentImage}
        onNext={handleNext}
        onPrevious={handlePrevious}
      />
    </div>
  )
}
export default ProductCarousel
