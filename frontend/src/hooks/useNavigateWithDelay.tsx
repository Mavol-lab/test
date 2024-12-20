import { useNavigate } from 'react-router'

export default function useNavigateWithDelay() {
  const navigate = useNavigate()

  const goTo = (route: string, delay: number = 300) => {
    setTimeout(() => {
      navigate(route)
    }, delay)
  }

  return goTo
}
