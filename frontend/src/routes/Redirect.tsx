import { useEffect } from 'react'

import useNavigateWithDelay from '../hooks/useNavigateWithDelay'

export default function Redirect() {
  const navigate = useNavigateWithDelay()

  useEffect(() => {
    navigate('/category/all')
  }, [])

  return <></>
}
