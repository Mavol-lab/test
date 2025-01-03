/**
 * Retrieves specified string in kebab case.
 */
export function toKebabCase(value: string) {
  return value
    .replace(/\s+/g, '-')
    .replace(/([a-z0-9])([A-Z])/g, '$1-$2')
    .toLowerCase()
}
