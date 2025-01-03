import classNames from 'classnames'
import React, { KeyboardEvent, useState } from 'react'

import Breakpoint from '../../enums/Breakpoint'
import useWindowSize from '../../hooks/useWindowSize'
import Button from '../Button/Button'
import ButtonColor from '../Button/types/ButtonColor'
import ButtonType from '../Button/types/ButtonType'
import Offcanvas from '../Offcanvas/Offcanvas'

type TProps = {
  /**
   * An array of navigation items to display.
   */
  items: string[]

  /**
   * The currently selected navigation item.
   */
  selected: string

  /**
   * Callback function to handle the selection of a navigation item.
   */
  onSelect: (value: string) => void
}

/**
 * HeaderNav component renders a navigation menu that adapts to different screen sizes.
 * It displays a horizontal menu on larger screens and a button that opens an off-canvas menu on smaller screens.
 */
function HeaderNav(props: TProps) {
  const [isVisibleOffcanvas, setIsVisibleOffcanvas] = useState(false)

  const { reachBreakpoint } = useWindowSize()

  /**
   * Handles the selection of a value.
   *
   * @param {string} value - The selected value.
   */
  const onSelect = (value: string) => {
    props.onSelect(value)
    setIsVisibleOffcanvas(false)
  }

  /**
   * Generates an object representing a menu item with accessibility features.
   *
   * @param {string} name - The name of the menu item.
   * @returns {object} An object containing properties for a menu item, including:
   * - `role`: The ARIA role for the menu item.
   * - `onClick`: A function to handle the click event, which calls `onSelect` with the item's name.
   * - `tabIndex`: The tab index for keyboard navigation.
   * - `onKeyDown`: A function to handle the keydown event, which calls `onSelect` with the item's name if the Enter or Space key is pressed.
   */
  const ulItem = (name: string): object => ({
    role: 'menuitem',
    tabIndex: 0,
    onKeyDown: (e: KeyboardEvent) => {
      if (e.key === 'Enter' || e.key === ' ') {
        onSelect(name)
      }
    },
    onClick: (e: React.MouseEvent) => {
      e.preventDefault()
      onSelect(name)
    },
  })

  /**
   * A JSX element representing a navigation menu for desktop view.
   */
  const desktop = (
    <ul
      className="col d-flex p-0 m-0 flex-grow-1 desktop header-nav"
      role="menu"
      aria-label="Navigation"
    >
      {props.items.map((item, i) => (
        <li
          className={classNames('h-100 px-3 pb-5', {
            selected: props.selected === item,
          })}
          key={i}
          {...ulItem(item)}
        >
          <a
            href={`/category/${item}`}
            aria-current={props.selected === item ? 'page' : undefined}
            data-testid={
              props.selected === item ? 'active-category-link' : 'category-link'
            }
          >
            {item.toUpperCase()}
          </a>
        </li>
      ))}
    </ul>
  )

  /**
   * Renders a mobile navigation component with a button to toggle an off-canvas menu.
   */
  const mobile = (
    <div className="col">
      <Button
        className="p-2"
        color={ButtonColor.Secondary}
        type={ButtonType.Transparent}
        onClick={() => setIsVisibleOffcanvas(true)}
        aria-label="Open menu"
      >
        <i className="icon icon-menu position-relative" aria-hidden="true" />
      </Button>

      <Offcanvas
        name="Menu"
        onClose={() => setIsVisibleOffcanvas(false)}
        visible={isVisibleOffcanvas}
        aria-label="Offcanvas menu"
      >
        <ul
          className="d-flex flex-column gap-3 align-items-start justify-content-center p-0 mt-5 mobile header-nav"
          role="menu"
          aria-label="Navigation"
        >
          {props.items.map((item, i) => (
            <li
              className={classNames('py-2', {
                selected: props.selected === item,
                'ps-3': props.selected === item,
              })}
              key={i}
              {...ulItem(item)}
            >
              <a
                href={`/category/${item}`}
                aria-current={props.selected === item ? 'page' : undefined}
                data-testid={
                  props.selected === item
                    ? 'active-category-link'
                    : 'category-link'
                }
              >
                {item.toUpperCase()}
              </a>
            </li>
          ))}
        </ul>
      </Offcanvas>
    </div>
  )

  return reachBreakpoint(Breakpoint.SM) ? desktop : mobile
}

export default React.memo(HeaderNav)
