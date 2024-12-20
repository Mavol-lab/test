import react from '@vitejs/plugin-react'
import { defineConfig } from 'vite'
import eslint from 'vite-plugin-eslint'

// https://vite.dev/config/
export default defineConfig({
  plugins: [react(), eslint()],
  css: {
    preprocessorOptions: {
      scss: {
        api: 'modern',
        silenceDeprecations: [
          'mixed-decls',
          'color-functions',
          'global-builtin',
          'import',
        ],
      },
    },
  },
})
