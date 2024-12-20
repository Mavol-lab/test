import typescript from '@typescript-eslint/eslint-plugin'
import typescriptParser from '@typescript-eslint/parser'
import { defineConfig } from 'eslint-define-config'
import eslintPluginPrettier from 'eslint-plugin-prettier'
import reactHooks from 'eslint-plugin-react-hooks'
import simpleImportSort from 'eslint-plugin-simple-import-sort'
import globals from 'globals'

export default defineConfig([
  {
    languageOptions: {
      ecmaVersion: 2020,
      sourceType: 'module',
      globals: {
        ...globals.browser,
        ...globals.node,
      },
      parser: typescriptParser,
    },
    plugins: {
      'react-hooks': reactHooks,
      prettier: eslintPluginPrettier,
      typescript,
      "simple-import-sort": simpleImportSort,
    },
    rules: {
      semi: ['error', 'never'],
      ...eslintPluginPrettier.configs.recommended.rules,
      quotes: ['error', 'single'],
      "simple-import-sort/imports": "error",
      "simple-import-sort/exports": "error",
      'react-hooks/rules-of-hooks': 'error',
      'react-hooks/exhaustive-deps': 'warn',
      "prettier/prettier": [
        "error",
        {
          "semi": false,
          "singleQuote": true,
          "parser": "typescript"
        },
        {
          "usePrettierrc": false
        }
      ],
    },
    files: ['**/*.tsx', '**/*.ts'],
  },
])
