import { useNavigate } from 'react-router'

/**
 * Custom hook that provides a function to navigate to a specified route with a delay.
 *
 * @returns {Function} A function that takes a route and an optional delay (default is 300ms) and navigates to the route after the delay.
 *
 * @example
 * const navigateWithDelay = useNavigateWithDelay();
 * navigateWithDelay('/home', 500); // Navigates to '/home' after 500ms
 */
export default function useNavigateWithDelay() {
  const navigate = useNavigate()

  /**
   * Navigates to a specified route after a delay.
   *
   * @param {string} route - The route to navigate to.
   * @param {number} [delay=300] - The delay in milliseconds before navigating. Defaults to 300ms.
   */
  const goTo = (route: string, delay: number = 300) => {
    setTimeout(() => {
      navigate(route)
    }, delay)
  }

  return goTo
}
