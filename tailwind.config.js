/** @type {import('tailwindcss').Config} */
export default {
  content: ['./src/**/*.{html,js,svelte,ts}'],
  theme: {
    extend: {
      colors:{
        'myblue':'#62a1ec',
        'bgsecondary':'#2B323B',
        'bgborder':'#444C56'
      }
    }
  },
  plugins: [],
}

