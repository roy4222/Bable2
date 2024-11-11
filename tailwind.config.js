/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./pages/**/*.{html,js,php}",
    "./includes/**/*.{html,js,php}",
    "./api/**/*.{html,js,php}"
  ],
  theme: {
    extend: {
      colors: {
        primary: {
          DEFAULT: '#FFD700',
          dark: '#1a242c',
        },
      },
      animation: {
        'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
      },
    },
  },
  plugins: [],
}