/** @type {import('tailwindcss').Config} */
module.exports = {
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
	plugins: []
};
