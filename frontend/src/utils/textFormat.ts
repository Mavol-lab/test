/**
 * Retrieves specified string in kebab case.
 */
const KEBAB_REGEX = /\p{Lu}/gu
const REVERSE_REGEX = /-\p{Ll}/gu

export function toKebabCase(input: string): string {
  return input
    .replace(KEBAB_REGEX, (match) => '-' + match.toLowerCase())
    .replace(REVERSE_REGEX, (match) => match.slice(1).toUpperCase())
    .replace(/^-/, '')
    .toLowerCase()
    .replace(/\s+/g, '-')
    .replace(/-+/g, '-')
}
