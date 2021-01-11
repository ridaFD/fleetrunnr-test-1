module.exports = {
    purge: [],
    purge: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
        backgroundColor: true,
    },
  },
  variants: {
    extend: {},
  },
  plugins: [
      require('@tailwindcss/custom-forms'),
  ],
}
