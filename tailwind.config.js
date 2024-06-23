/** @type {import('tailwindcss').Config} */
export default {
  content: [
      "./resources/**/*.blade.php",
      "./resources/**/*.js",
      "./resources/**/*.vue",
  ], theme: {
    extend: {
        colors: {
          'gray': '#272626',
        },
        fontFamily: {
            'serif': ['Gibson', 'sans-serif'],
            'sans': ['Figtree', 'sans-serif']
        },
    },
  }, plugins: [],
}

