module.exports = {
    purge: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    darkMode: false, // or 'media' or 'class'
    theme: {
        extend: {
            blur: ['hover', 'focus'],
            transitionDuration: {
                '0': '0ms',
                '2000': '2000ms',
                '3000': '3000ms'
            },
        }
    },
    variants: {
        extend: {},
    },
    plugins: [
        require('daisyui'),
    ],
}
