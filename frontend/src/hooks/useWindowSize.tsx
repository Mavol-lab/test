import { useCallback, useEffect, useMemo, useState } from 'react'

import Breakpoint from '../enums/Breakpoint'

const breakpoints: { [key in Breakpoint]: number } = {
  [Breakpoint.XS]: 0,
  [Breakpoint.SM]: 576,
  [Breakpoint.MD]: 768,
  [Breakpoint.LG]: 992,
  [Breakpoint.XL]: 1200,
  [Breakpoint.XXL]: 1400,
}

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
