import React from 'react'

const CatalogPlaceholder: React.FC = () => {
  return (
    <>
      <h1 className="placeholder-glow fs-0">
        <span
          className="placeholder col-2 placeholder-xl"
          aria-label="Loading category name"
        ></span>
      </h1>
      <div
        className="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-4 mt-sm-3 mt-lg-7"
        aria-live="polite"
      >
        {Array.from([1, 2, 3, 4, 5, 6]).map((_, index) => (
          <div
            key={index}
            className="p-3 placeholder-glow gap-4 d-flex flex-column"
            style={{ height: 422 }}
            aria-label="Loading product"
          >
            <div
              className="placeholder p-md-3"
              style={{ width: '100%', height: 330 }}
              aria-label="Loading product image"
            ></div>
            <div className="d-flex flex-column gap-1">
              <p
                className="placeholder col-5 fs-4 m-0"
                aria-label="Loading product name"
              ></p>
              <span>
                ${' '}
                <p
                  className="placeholder col-2 fs-4 m-0"
                  aria-label="Loading product price"
                ></p>
              </span>
            </div>
          </div>
        ))}
      </div>
    </>
  )
}

export default CatalogPlaceholder
