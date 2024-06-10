import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'textColor': '#505050',
                'textColorDisabled': '#B2BCCB',
                'accent-1': '#3898DE',
                'accent-2': '#00D1FF',
                'accent-3': '#BAE2FF',
            },
        },
    },

    plugins: [forms],
};
