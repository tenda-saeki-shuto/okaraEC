import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    safelist: [
        'no-underline',
        'hover:no-underline',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            clipPath: {
                'circle-small': 'circle(0% at calc(100% - 44px) 44px)',
                'circle-large': 'circle(150% at calc(100% - 44px) 44px)',
            },
        },
    },

    plugins: [
        forms,
        function ({ addUtilities }) {
            addUtilities({
                '.clip-circle-small': {
                    'clip-path': 'circle(0% at calc(100% - 44px) 44px)',
                },
                '.clip-circle-large': {
                    'clip-path': 'circle(150% at calc(100% - 44px) 44px)',
                },
            });
        },

    ],
};
