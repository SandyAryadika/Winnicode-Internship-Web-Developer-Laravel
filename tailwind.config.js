/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  theme: {
    extend: {
      fontFamily: {
        sans: ['Inter', 'sans-serif'],
      },
      typography: (theme) => ({
        DEFAULT: {
          css: {
            color: theme('colors.gray.800'),
            fontFamily: theme('fontFamily.sans').join(', '),
            h2: {
              fontSize: theme('fontSize.4xl')[0],
              fontWeight: '700',
              color: theme('colors.gray.900'),
              marginBottom: '1rem',
              marginTop: '2rem',
            },
            h3: {
              fontSize: theme('fontSize.2xl')[0],
              fontWeight: '600',
              color: theme('colors.gray.800'),
              marginBottom: '0.75rem',
              marginTop: '1.5rem',
            },
            strong: {
              fontWeight: '600',
              textTransform: 'uppercase',
              fontSize: theme('fontSize.lg')[0],
            },
            em: {
              fontStyle: 'italic',
            },
          },
        },
      }),
    },
  },
  plugins: [require('@tailwindcss/typography')],
};
