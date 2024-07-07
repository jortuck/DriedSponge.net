// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
	devtools: { enabled: true },
	modules: ["@nuxtjs/tailwindcss"],
	app: {
		pageTransition: {
			name: "page", mode: "out-in"
		},
		head:{
			link:[{rel:"icon", href:"/favicon.webp"}],
		}
	}

});
