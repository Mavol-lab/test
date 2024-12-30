import {
  createContext,
  PropsWithChildren,
  useContext,
  useEffect,
  useRef,
  useState,
} from 'react'
import { useLocation, useNavigate } from 'react-router'

type TProps = PropsWithChildren & {}

type TAnimationState = 'idle' | 'fadingIn' | 'fadingOut'

type TNavigationContext = {
  navigate: (route: string) => boolean
  animationState: TAnimationState
}

const initialContext: TNavigationContext = {
  navigate: () => false,
  animationState: 'idle',
}

const NavigationContext = createContext<TNavigationContext>(initialContext)

export function NavigationProvider(props: TProps) {
  const [animationState, setAnimationState] = useState<TAnimationState>('idle')
  const [isNavigatorBlocked, setIsNavigatorBlocked] = useState(false)

  const nav = useNavigate()
  const currentRoute = useLocation()

  const fadeInTimeout = useRef<NodeJS.Timeout | null>(null)
  const fadeOutTimeout = useRef<NodeJS.Timeout | null>(null)

  const navigate = (route: string) => {
    if (isNavigatorBlocked || currentRoute.pathname === route) {
      return false
    }

    const isAbsolutePath = route[0] === '/'
    const newPath = isAbsolutePath ? route : `${currentRoute.pathname}/${route}`

    setIsNavigatorBlocked(true)
    setAnimationState('fadingOut')

    fadeOutTimeout.current = setTimeout(() => {
      nav(newPath)
    }, 300)

    return true
  }

  useEffect(() => {
    setAnimationState('idle')
    fadeInTimeout.current = setTimeout(() => {
      setAnimationState('fadingIn')
      setIsNavigatorBlocked(false)

      fadeInTimeout.current = null
      fadeOutTimeout.current = null
    }, 300)
  }, [currentRoute])

  return (
    <NavigationContext.Provider
      value={{ navigate, animationState }}
      {...props}
    />
  )
}

export const useNavigationContext = () => {
  const context = useContext(NavigationContext)

  return context
}
