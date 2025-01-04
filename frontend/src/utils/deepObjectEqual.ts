/**
 * Compares two objects for deep equality.
 *
 * This function checks if two objects are deeply equal by comparing their properties and values recursively.
 * It handles nested objects and arrays, and returns `true` if the objects are deeply equal, and `false` otherwise.
 */
export function deepEqual<T>(obj1: T, obj2: T) {
  if (obj1 === obj2) {
    return true // Checking for link identity.
  }

  if (
    obj1 == null ||
    typeof obj1 !== 'object' ||
    obj2 == null ||
    typeof obj2 !== 'object'
  ) {
    return false // Objects are not equal unless one of them is an object or null.
  }

  const keys1 = Object.keys(obj1)
  const keys2 = Object.keys(obj2)

  if (keys1.length !== keys2.length) {
    return false // Objects are not equal if they have different numbers of properties.
  }

  for (const key of keys1) {
    if (typeof obj1[key as keyof T] === 'object') {
      if (!deepEqual(obj1[key as keyof T], obj2[key as keyof T])) {
        return false
      }
    }

    if (
      !keys2.includes(key) ||
      !deepEqual(obj1[key as keyof T], obj2[key as keyof T])
    ) {
      return false // Objects are not equal if they have different keys or the values of those keys.
    }
  }

  return true
}

/**
 * Creates a deep clone of the given object or array.
 */
export function deepClone<T>(obj: T): T {
  if (obj === null || typeof obj !== 'object') {
    return obj
  }

  if (Array.isArray(obj)) {
    const arrClone = [] as unknown as any[]

    for (let i = 0; i < (obj as unknown as any[]).length; i++) {
      arrClone[i] = deepClone((obj as unknown as any[])[i])
    }
    return arrClone as T
  }

  const objClone = {} as T
  for (const key in obj) {
    if (Object.prototype.hasOwnProperty.call(obj, key)) {
      objClone[key as keyof T] = deepClone(obj[key as keyof T])
    }
  }
  return objClone
}
