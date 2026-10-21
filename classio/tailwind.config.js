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
                navy: {
                    DEFAULT: '#0a192f',
                    light: '#112240',
                    dark: '#020c1b',
                },
                cream: '#fdfbf7',
                gold: {
                    DEFAULT: '#c5a059',
                    light: '#d4b77a',
                    dark: '#a88647',
                },
                teal: {
                    DEFAULT: '#14303f',
                    dark: '#0d222d',
                }
            },
            fontFamily: {
                serif: ['Playfair Display', 'serif'],
                sans: ['Montserrat', 'sans-serif'],
            },
            boxShadow: {
                'card': '0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03)',
            }
        },
    },
    plugins: [],
}
