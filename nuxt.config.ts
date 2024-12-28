// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
	devtools: { enabled: true },
	modules: ["@nuxtjs/tailwindcss", "@nuxt/content"],
	runtimeConfig: {
		public: {
			turnstileKey: ""
		},
		turnstileSecret: "",
		awsAccessKeyId: "",
		awsSecretAccessKey: "",
		mailDestination: "",
		discordWebhook: ""
	},
	// routeRules:{
	// 	'/projects/*':{prerender:true},
	// 	'/projects':{prerender:true},
	// 	'/':{prerender:true}
	// },
	app: {
		pageTransition: {
			name: "page",
			mode: "out-in",
			enabled: false
		},
		head: {
			link: [{ rel: "icon", href: "/favicon.webp" }],
			htmlAttrs: {
				lang: "en"
			},
			script: [{ src: "https://challenges.cloudflare.com/turnstile/v0/api.js?render=explicit" }]
		}
	},

	compatibilityDate: "2024-10-16"
});
