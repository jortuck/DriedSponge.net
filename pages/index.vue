<script setup lang="ts">
import Shield from "~/components/Shield.vue";
const config = useRuntimeConfig();
useSeoMeta({
	title: "Home | Jordan Tucker",
	ogTitle: "Home | Jordan Tucker",
	description: "Hello, my name is Jordan. I'm a student studying Informatics at the University of Washington. I enjoy creating websites, Discord bots, & more!",
	ogDescription: "Hello , my name is Jordan. I'm a student studying Informatics at the University of Washington. I enjoy creating websites, Discord bots, & more!",
	ogUrl: "https://jortuck.com"
});
onMounted(()=>{
	//@ts-ignore
	window.turnstile.ready(function () {
		// @ts-ignore
		let turnstileId = window.turnstile.render(".cf-turnstile", {
			sitekey: config.public.turnstileKey,
			callback: function (token: string) {
				console.log(`Challenge Success ${token}`);
				},
			"error-callback": function () {
				}
		});
	});
})
</script>
<template>
	<div class="space-y-32">
		<section
			class="mt-20 md:mt-28 lg:mt-40"
		>
			<section class="w-full text-center md:space-y-6 lg:text-left">
				<div
					class="h-full space-y-9 lg:space-y-6 tracking-tighter lg:pr-10 bg-gradient-to-br from-white via-primary to-white to-70%  bg-clip-text text-transparent">
					<h1 class="text-5xl lg:text-7xl font-semibold xl:text-8xl tracking-tighter select-none cooltext">
						Hi, I'm Jordan.
					</h1>
					<h2 class="text-4xl font-semibold sm:h-auto xl:text-6xl tracking-tighter select-none cooltext">I'm an
						Informatics student
						at the University of Washington.</h2>
					<div class="text-5xl space-x-6">
						<a
							target="_blank"
							class="social-link cooltext"
							href="https://github.com/jortuck"
							title="Github"
						>
							<i class="fa-brands fa-github"></i>
						</a>
						<a
							target="_blank"
							class="social-link cooltext"
							href="https://linkedin.com/in/jortuck"
							title="Linked In"
						>
							<i class="fa-brands fa-linkedin"></i>
						</a>
					</div>
				</div>
			</section>
		</section>
		<section class="mb-96 space-y-10">
			<div class="space-y-8">
				<ProseH2>
					About Me
				</ProseH2>
				<ProseP>
					Hi my name is Jordan, I'm a student studying
					<NuxtLink class="text-primary hover:underline" external target="_blank"
										to="https://ischool.uw.edu/programs/informatics">Informatics
					</NuxtLink>
					at the
					<NuxtLink to="https://washington.edu" external target="_blank">University of
						Washington
					</NuxtLink>
					. I have been teaching myself
					to program since 2019, and have focused my efforts in web development, server-side applications, and data
					science applications. My most recent project involved working at the University of Washington's
					<NuxtLink class="text-primary hover:underline" to="https://ocean.washington.edu" external target="_blank">
						School
						of Oceanography
					</NuxtLink>
					as a research assistant, building an interactive web application for the visualization
					of paleocliamte data reconstructions. You can check it out at
					<NuxtLink class="text-primary hover:underline" to="https://pv.jortuck.com" external target="_blank">
						https://pv.jortuck.com
					</NuxtLink>
					.
				</ProseP>
			</div>
			<div>
				<ProseH2>
					Featured Projects
				</ProseH2>
			</div>
			<div class="space-y-4">
				<ProseH2 id="contact">
					Contact
				</ProseH2>
				<ProseP>
					Fill out this form to send a message directly to my inbox! No matter what you have to say, I would love to
					hear from you! Feedback on this website is also much appreciated. You can also reach me on Discord if that's
					your preferred method of communication, my username is <strong>jortuck</strong>.
				</ProseP>
				<div class="flex flex-row items-center justify-center w-full">
					<form class="my-6 rounded-md flex flex-col space-y-5 w-full">
						<div class="flex md:flex-row flex-col w-full md:space-x-4 space-y-5 md:space-y-0">
							<label
							>Name*
								<input name="name" type="text" placeholder="Chris P. Bacon" />
							</label>
							<label
							>Email*
								<input name="email" type="text" placeholder="email@example.com" />
							</label>
						</div>
						<div class="space-y-5">
							<label
							>Subject (required)
								<input placeholder="A nice message." name="subject" type="text" /></label>
							<label
							>Message*
								<textarea name="message"
													rows="4"
													placeholder="Had a slight weapons malfunction but, uh everything’s perfectly all right now. We’re fine. We’re all fine here now. Thank you. How are you?"></textarea>
							</label>
						</div>
						<div
							class="flex flex-col content-center items-center space-y-3 md:flex-row md:space-x-3 md:space-y-0"
						>
							<div class="cf-turnstile"></div>
							<p
								class=" block text-center text-sm text-red-400 md:text-left"
							>
							</p>
						</div>
						<button type="submit" class="block bg-base-200 rounded-md p-3 text-white hover:bg-primary transition-colors duration-200 ease-in-out">
							<i class="fa-solid fa-paper-plane"></i> Send
						</button>
					</form>
				</div>
			</div>
		</section>
	</div>
</template>
<style scoped lang="postcss">
.social-link {
	@apply transition-colors duration-200 ease-in-out hover:text-white;
}

input {
	@apply bg-base-200  active:bg-base-300 focus:bg-base-300 text-white focus:border-primary;
	@apply block w-full mt-1 rounded-md border-2 border-transparent p-2 transition-colors duration-200 ease-in-out focus:outline-none font-normal;
}

label {
	@apply block w-full text-white font-bold;
}

textarea {
	@apply bg-base-200 active:bg-base-300 focus:bg-base-300 text-white focus:border-primary;
	@apply block w-full rounded-md border-2 border-transparent p-2 mt-1 transition-colors duration-200 ease-in-out focus:outline-none font-normal;
}

.small-heading {
	@apply text-2xl md:text-3xl font-bold bg-gradient-to-br from-white via-primary to-white bg-clip-text text-transparent;
}

.section-paragraph {
	@apply text-gray-200 text-lg;
}

.section-paragraph > a {
	@apply text-primary hover:underline;
}
</style>