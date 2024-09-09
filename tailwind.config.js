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
                header: '#1A1A1A',  
                body: '#848484',
                border: '#2d2d2d',
                accent: '#4FA8C0',  
                highlight_accent: '#63b2c7',
                text: '#FAFAFA',
              },
        },
    },

    plugins: [forms],
};
