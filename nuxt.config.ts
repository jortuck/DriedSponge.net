// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
	devtools: { enabled: true },
	modules: ["@nuxtjs/tailwindcss", "@nuxt/content"],
	runtimeConfig:{
		public:{
			turnstileKey:''
		}
	},
	routeRules:{
		'/api/*':{prerender:false},
		'/*':{prerender:true}
	},
	app: {
		// pageTransition: {
		// 	name: "page", mode: "out-in"
		// },
		head: {
			link: [{ rel: "icon", href: "/favicon.webp" }],
			htmlAttrs:{
				lang: "en"
			},
			script: [
				{src:"https://challenges.cloudflare.com/turnstile/v0/api.js?render=explicit"}
			]
		}
	},

	compatibilityDate: "2024-10-16"
});