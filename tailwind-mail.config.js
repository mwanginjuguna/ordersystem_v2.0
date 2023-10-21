const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors')

module.exports = {
    content: [
        './resources/views/emails/**/*.blade.php',
        './resources/views/emails/*.blade.php',
        './resources/views/emails/**/**/*.blade.php',
        './resources/views/emails/**/**/*.vue'

    ],
    theme: {
        screens: {
            'xxs': '375px',
            'xs': '475px',
            ...defaultTheme.screens,
        },
        fontFamily: {
            'sans': ['"DM Sans"', 'system-ui'],
            'filament': ['DM Sans', ...defaultTheme.fontFamily.sans],
            'serif': ['Georgia', 'ui-serif'],
            'display': ['"PP Eiko"', 'system-ui'],
            'mono': ["JetBrains Mono", 'monospace']
        },
        extend: {
            colors: {
                danger: colors.rose,
                primary: colors.sky,
                success: colors.lime,
                warning: colors.yellow,
            },
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
    ],
}
