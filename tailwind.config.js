module.exports = {
  future: {
    // removeDeprecatedGapUtilities: true,
    // purgeLayersByDefault: true,
  },
  purge: [],
  theme: {
    extend: {
        colors: {
            'eae-dark': '#001845',
            'eae-light': '#D4E6F6',
        },
        textColor: {
            'eae-dark': '#001845',
            'eae-light': '#D4E6F6',
        },
        width: {
            '500': '500px',
            '748': '748px',
        }
    },
  },
  variants: {},
  plugins: [
      require('@tailwindcss/ui'),
  ],
}
