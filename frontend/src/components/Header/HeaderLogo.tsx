/**
 * HeaderLogo component renders the logo image inside a div with specific classes for styling.
 */
function HeaderLogo() {
  return (
    <div className="header-logo mb-2 mb-md-3 col align-items-start justify-content-center d-flex">
      <img
        width={41}
        src="/logo.svg"
        alt="Company Logo"
        aria-label="Company Logo"
      />
    </div>
  )
}

export default HeaderLogo
