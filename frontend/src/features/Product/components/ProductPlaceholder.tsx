import React from 'react'

const ProductPlaceholder: React.FC = () => {
  return (
    <>
      <div className="d-flex row placeholder-glow" aria-live="polite">
        <div
          className="d-flex flex-column gap-2 col-1"
          aria-label="Image placeholders"
        >
          <div
            className="placeholder"
            style={{ height: 80 }}
            aria-hidden="true"
          ></div>
          <div
            className="placeholder"
            style={{ height: 80 }}
            aria-hidden="true"
          ></div>
          <div
            className="placeholder"
            style={{ height: 80 }}
            aria-hidden="true"
          ></div>
        </div>
        <div
          className="placeholder col-7"
          style={{ height: 400 }}
          aria-label="Main image placeholder"
        ></div>
        <div
          className="col-4 d-flex flex-column"
          aria-label="Product details placeholders"
        >
          <div className="placeholder col-4 fs-0" aria-hidden="true"></div>
          <div className="placeholder col-3 fs-3 mt-7" aria-hidden="true"></div>
          <span className="mt-2">
            $ <div className="placeholder col-3 fs-4" aria-hidden="true"></div>
          </span>
          <div
            className="placeholder col-9 fs-0 mt-5 bg-primary"
            aria-hidden="true"
          ></div>
          <div className="placeholder col-5 fs-1 mt-3" aria-hidden="true"></div>
          <div
            className="d-flex flex-wrap gap-1 mt-3"
            aria-label="Attribute placeholders"
          >
            <div
              className="placeholder col-2 fs-4 mt-1"
              aria-hidden="true"
            ></div>
            <div
              className="placeholder col-3 fs-4 mt-1"
              aria-hidden="true"
            ></div>
            <div
              className="placeholder col-2 fs-4 mt-1"
              aria-hidden="true"
            ></div>
            <div
              className="placeholder col-1 fs-4 mt-1"
              aria-hidden="true"
            ></div>
            <div
              className="placeholder col-4 fs-4 mt-1"
              aria-hidden="true"
            ></div>
            <div
              className="placeholder col-3 fs-4 mt-1"
              aria-hidden="true"
            ></div>
            <div
              className="placeholder col-6 fs-4 mt-1"
              aria-hidden="true"
            ></div>
            <div
              className="placeholder col-4 fs-4 mt-1"
              aria-hidden="true"
            ></div>
            <div
              className="placeholder col-3 fs-4 mt-1"
              aria-hidden="true"
            ></div>
            <div
              className="placeholder col-3 fs-4 mt-1"
              aria-hidden="true"
            ></div>
            <div
              className="placeholder col-3 fs-4 mt-1"
              aria-hidden="true"
            ></div>
          </div>
        </div>
      </div>
    </>
  )
}

export default ProductPlaceholder
