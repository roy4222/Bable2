/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./includes/**/*.{html,js,php}",
    "./pages/**/*.{html,js,php}",
    "./*.php",
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