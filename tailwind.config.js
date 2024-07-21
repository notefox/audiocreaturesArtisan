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
        container: {
            screens: {
                sm: '600px',
                md: '728px',
                lg: '984px',
                xl: '1240px',
            }
        },
        fontSize: {
            'xs': ['8px', ''],
            'sm': ['12px', ''],
            'base': ['16px', ''],
            'xl': ['16px', '24px'],
            '2xl': ['20px', '28px'],
            '3xl': ['32px', '42px'],
            '4xl': ['40px', ''],
            '5xl': ['54px', '']
        },
        extend: {
            colors: {
                'primary': '#CE1BA7',
                'secondary': '#F1C93A',
                'third': '#33C5E6',
                'gray': {
                    ...defaultTheme.colors['gray'],
                    900: '#272626'
                },
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                serif: ['Gibson', ...defaultTheme.fontFamily.serif],
            },
            gridTemplateColumns: {
                'dashboard': '1fr 9fr'
            }
        },
    },

    plugins: [forms],
};
