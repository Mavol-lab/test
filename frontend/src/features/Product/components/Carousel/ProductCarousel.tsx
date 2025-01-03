import classNames from 'classnames'
import { useState } from 'react'

import Carousel from '../../../../components/Carousel/Carousel'
import Image from '../../../../components/Image/Image'
import Breakpoint from '../../../../enums/Breakpoint'
import useWindowSize from '../../../../hooks/useWindowSize'

type TProps = {
  src: string[]
}

/**
 * Component that displays a product image carousel with thumbnails.
 */
function ProductCarousel(props: TProps) {
  const [currentImage, setCurrentImage] = useState(props.src[0])
  const { reachBreakpoint } = useWindowSize()

  /**
   * Advances to the next image in the carousel.
   * If the current image is the last one in the array, it wraps around to the first image.
   */
  const handleNext = (): void => {
    const next = props.src.indexOf(currentImage) + 1

    setCurrentImage(
      next > props.src.length - 1 ? props.src[0] : props.src[next],
    )
  }

  /**
   * Handles the action of moving to the previous image in the carousel.
   * It calculates the previous image index based on the current image index.
   * If the current image is the first one, it wraps around to the last image.
   */
  const handlePrevious = (): void => {
    const prev = props.src.indexOf(currentImage) - 1

    setCurrentImage(
      prev < 0 ? props.src[props.src.length - 1] : props.src[prev],
    )
  }

  /**
   * Generates a subarray from the given array, centered around the activeIndex and extending offset elements in both directions.
   * If the offset extends beyond the bounds of the array, it wraps around to the beginning or end of the array.
   *
   * @template T - The type of elements in the array.
   * @param {number} activeIndex - The index around which the subarray is centered.
   * @param {T[]} array - The array from which to generate the subarray.
   * @param {number} offset - The number of elements to include on either side of the activeIndex.
   * @returns {T[]} A subarray of the original array, centered around the activeIndex and extending offset elements in both directions.
   */
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
      aria-label="Product image carousel"
    >
      <div
        className="d-flex flex-row flex-lg-column gap-2"
        aria-label="Thumbnail images"
      >
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
            aria-current={currentImage === image ? 'true' : 'false'}
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
        aria-label="Main product image"
      />
    </div>
  )
}
export default ProductCarousel
