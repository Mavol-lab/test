import { useCallback, useEffect, useMemo, useState } from 'react'

import Breakpoint from '../enums/Breakpoint'

/**
 * An object representing the breakpoints for different screen sizes.
 * Each key corresponds to a specific breakpoint and its associated pixel value.
 *
 * Breakpoints:
 * - XS: 0px
 * - SM: 576px
 * - MD: 768px
 * - LG: 992px
 * - XL: 1200px
 * - XXL: 1400px
 *
 * @type {Object.<Breakpoint, number>}
 */
const breakpoints: { [key in Breakpoint]: number } = {
  [Breakpoint.XS]: 0,
  [Breakpoint.SM]: 576,
  [Breakpoint.MD]: 768,
  [Breakpoint.LG]: 992,
  [Breakpoint.XL]: 1200,
  [Breakpoint.XXL]: 1400,
}

/**
 * Custom hook that tracks the window width and provides a function to check if the current window width
 * has reached a specified breakpoint.
 *
 * @returns {Object} An object containing:
 * - `reachBreakpoint`: A function that takes a `Breakpoint` and returns a boolean indicating if the current window width has reached the specified breakpoint.
 *
 * @example
 * const { reachBreakpoint } = useWindowSize();
 * const isLargeScreen = reachBreakpoint(Breakpoint.LG);
 */
export default function useWindowSize() {
  const [windowWidth, setWindowSize] = useState(window.innerWidth ?? 0)

  useEffect(() => {
    const handleResize = () => {
      setWindowSize(window.innerWidth)
    }

    window.addEventListener('resize', handleResize)

    return () => {
      window.removeEventListener('resize', handleResize)
    }
  }, [])

  /**
   * Computes an array of breakpoint names that correspond to the current window width.
   *
   * @returns {string[]} An array of breakpoint names as strings.
   */
  const sizes: string[] = useMemo(() => {
    return Object.entries(breakpoints)
      .filter(([, breakpoint]) => windowWidth >= breakpoint)
      .map(([key]) => Breakpoint[key as keyof typeof Breakpoint].toString())
  }, [windowWidth])

  const reachBreakpoint = useCallback(
    (size: Breakpoint) => sizes.includes(Breakpoint[size]),
    [sizes],
  )

  return { reachBreakpoint }
}
