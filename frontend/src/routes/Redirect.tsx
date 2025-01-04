import { useEffect } from 'react'

import useNavigateWithDelay from '../hooks/useNavigateWithDelay'

/**
 * Redirect component that navigates to the '/all' route
 * immediately after it is mounted.
 */
export default function Redirect() {
  const navigate = useNavigateWithDelay()

  useEffect(() => {
    navigate('/all')
  }, [navigate])

  return <></>
}
