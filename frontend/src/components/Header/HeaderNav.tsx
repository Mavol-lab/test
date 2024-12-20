import classNames from 'classnames'
import { KeyboardEvent, useState } from 'react'

import Breakpoint from '../../enums/Breakpoint'
import useWindowSize from '../../hooks/useWindowSize'
import Button from '../Button/Button'
import ButtonColor from '../Button/types/ButtonColor'
import ButtonType from '../Button/types/ButtonType'
import Offcanvas from '../Offcanvas/Offcanvas'

type TProps = {
  items: string[]
  selected: string
  onSelect: (value: string) => void
}

function HeaderNav(props: TProps) {
  const [isVisibleOffcanvas, setIsVisibleOffcanvas] = useState(false)

  const { reachBreakpoint } = useWindowSize()

  const onSelect = (value: string) => {
    props.onSelect(value)
    setIsVisibleOffcanvas(false)
  }

  const ulItem = (name: string) => {
    return {
      role: 'menuitem',
      onClick: () => onSelect(name),
      tabIndex: 0,
      onKeyDown: (e: KeyboardEvent) => {
        if (e.key === 'Enter' || e.key === ' ') {
          onSelect(name)
        }
      },
    }
  }

  const desktop = (
    <ul
      className="col d-flex p-0 m-0 flex-grow-1"
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
          {item.toUpperCase()}
        </li>
      ))}
    </ul>
  )

  const mobile = (
    <div className="col">
      <Button
        className="p-2"
        color={ButtonColor.Secondary}
        type={ButtonType.Transparent}
        onClick={() => setIsVisibleOffcanvas(true)}
      >
        <i className="icon icon-menu position-relative" />
      </Button>

      <Offcanvas
        name="Menu"
        onClose={() => setIsVisibleOffcanvas(false)}
        visible={isVisibleOffcanvas}
      >
        <ul
          className="d-flex flex-column gap-3 align-items-start p-0 mt-5"
          role="menu"
          aria-label="Navigation"
        >
          {props.items.map((item, i) => (
            <li
              data-testid={
                props.selected === item
                  ? 'active-category-link'
                  : 'category-link'
              }
              className={classNames('pb-2', {
                selected: props.selected === item,
              })}
              key={i}
              {...ulItem(item)}
            >
              {item.toUpperCase()}
            </li>
          ))}
        </ul>
      </Offcanvas>
    </div>
  )

  return reachBreakpoint(Breakpoint.SM) ? desktop : mobile
}

export default HeaderNav
