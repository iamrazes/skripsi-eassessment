/** @type {import('tailwindcss').Config} */
export default {
    content: [
      "./resources/**/*.blade.php",
      "./resources/**/*.js",
      "./resources/**/*.vue",
    ],
    theme: {
      extend: {
        colors: {
            'textColor': '#505050',
            'textColorDisabled': '#B2BCCB',
            'accent-1': '#3898DE',
            'accent-2': '#00D1FF',
            'accent-3': '#BAE2FF',
        },
    },
    },
    plugins: [],
  }
