export default class IndexedDBService<T> {
  private dbName: string
  private storeName: string

  constructor(dbName: string, storeName: string) {
    this.dbName = dbName
    this.storeName = storeName
  }

  private openDatabase(): Promise<IDBDatabase> {
    return new Promise((resolve, reject) => {
      const request = indexedDB.open(this.dbName, 1)

      request.onupgradeneeded = () => {
        const db = request.result

        if (!db.objectStoreNames.contains(this.storeName)) {
          db.createObjectStore(this.storeName, { keyPath: 'id' })
        }
      }

      request.onsuccess = () => resolve(request.result)
      request.onerror = () => reject(request.error)
    })
  }

  async addItem(item: T): Promise<void> {
    const db = await this.openDatabase()
    const transaction = db.transaction(this.storeName, 'readwrite')
    const store = transaction.objectStore(this.storeName)

    store.put(item)

    return new Promise((resolve, reject) => {
      transaction.oncomplete = () => resolve()
      transaction.onerror = () => reject(transaction.error)
    })
  }

  async getAllItems(): Promise<T[]> {
    const db = await this.openDatabase()
    const transaction = db.transaction(this.storeName, 'readonly')
    const store = transaction.objectStore(this.storeName)

    return new Promise((resolve, reject) => {
      const request = store.getAll()

      request.onsuccess = () => resolve(request.result as T[])
      request.onerror = () => reject(request.error)
    })
  }

  async getItemById(id: number): Promise<T | undefined> {
    const db = await this.openDatabase()
    const transaction = db.transaction(this.storeName, 'readonly')
    const store = transaction.objectStore(this.storeName)

    return new Promise((resolve, reject) => {
      const request = store.get(id)

      request.onsuccess = () => resolve(request.result as T | undefined)
      request.onerror = () => reject(request.error)
    })
  }

  async removeItem(id: number): Promise<void> {
    const db = await this.openDatabase()
    const transaction = db.transaction(this.storeName, 'readwrite')
    const store = transaction.objectStore(this.storeName)

    store.delete(id)

    return new Promise((resolve, reject) => {
      transaction.oncomplete = () => resolve()
      transaction.onerror = () => reject(transaction.error)
    })
  }

  async clearStore(): Promise<void> {
    const db = await this.openDatabase()
    const transaction = db.transaction(this.storeName, 'readwrite')
    const store = transaction.objectStore(this.storeName)

    store.clear()

    return new Promise((resolve, reject) => {
      transaction.oncomplete = () => resolve()
      transaction.onerror = () => reject(transaction.error)
    })
  }
}
