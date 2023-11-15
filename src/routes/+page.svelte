<script lang="ts">
	import IconLink from "$lib/IconLink.svelte";
	import { fade } from "svelte/transition";
	import { PUBLIC_STATS_ENDPOINT, PUBLIC_TURNSTILE_SITE_KEY } from "$env/static/public";
	import { enhance } from "$app/forms";
	import Skillcard from "$lib/Skillcard.svelte";
	import { onMount } from "svelte";
	import Projects from "$lib/Projects.svelte";
	import type { PageData, ActionData } from "./$types";
	import { page } from "$app/stores";
	export let data: PageData;
	let errors = {};
	export let form: ActionData;
	import { contactSchema } from "$lib/Validator";
	const socials = [
		{
			link: "https://github.com/driedsponge",
			icon: "fa-brands fa-github",
			name: "Github"
		},
		{
			link: `#contact`,
			icon: "fa-solid fa-envelope",
			name: "Email"
		}
	];
	let gallery = [
		{
			imgUrl: `${PUBLIC_STATS_ENDPOINT}?username=driedsponge&include_all_commits=true&hide_border=true&layout=compact&theme=dark&bg_color=2B323B&border_radius=10&cache_seconds=21600&custom_title=My Github Stats&show_icons=true&icon_color=62a1ec`,
			imgDes: "My Github Stats",
			imgMobile: `${PUBLIC_STATS_ENDPOINT}?username=driedsponge&include_all_commits=true&hide_border=true&layout=compact&theme=dark&bg_color=2B323B&border_radius=10&cache_seconds=21600&custom_title=My Github Stats&show_icons=true&icon_color=62a1ec&hide_rank=true&card_width=290`
		}
	];
	let statsInfo = gallery[0];
	let welcomeText: string = "Hello";
	let welcomeTextFinal: string = "";
	let errorMsg = "";
	onMount(() => {
		const timeOfDay = new Date().getHours();
		if (timeOfDay >= 6 && timeOfDay < 12) {
			welcomeText = "Good Morning!";
		} else if (timeOfDay >= 12 && timeOfDay < 18) {
			welcomeText = "Good Afternoon!";
		} else if (timeOfDay >= 18 && timeOfDay < 22) {
			welcomeText = "Good Evening!";
		} else {
			welcomeText = "Hello!";
		}
		for (let i = 0; i < welcomeText.length; i++) {
			setTimeout(() => {
				welcomeTextFinal += welcomeText.split("")[i];
			}, 100 * i);
		}
	});

	let solvedCaptcha = false;
	let turnstileId;

	onMount(() => {
		// @ts-ignore
		window.turnstile.ready(function () {
			// @ts-ignore
			turnstileId = window.turnstile.render(".cf-turnstile", {
				sitekey: PUBLIC_TURNSTILE_SITE_KEY,
				callback: function (token) {
					console.log(`Challenge Success ${token}`);
					solvedCaptcha = true;
					errorMsg = "";
				},
				"error-callback": function () {
					errorMsg =
						"Our CAPTCHA has detected that you are a bot. The check will run again in 8 seconds.";
				}
			});
		});
	});
	async function validate(field, value) {
		try {
			await contactSchema.validateAt(field, value);
			if (errors[field]) {
				errors[field] = null;
				delete errors[field];
			}
		} catch (e) {
			errors[field] = e.errors[0];
		}
	}
</script>

<svelte:head>
	<title>Jordan Tucker | Home</title>
	<meta
		property="og:site_name"
		content="jordantucker.dev"
	/>
	<meta
		name="description"
		content="Hello 👋, my name is Jordan. I'm a student at the University of Washington studying informatics. I enjoy creating websites, Discord bots, & more!"
	/>
	<meta
		property="og:title"
		content="Jordan Tucker | Home"
	/>
	<meta
		property="og:description"
		content="Hello 👋, my name is Jordan. I'm a student at the University of Washington studying informatics. I enjoy creating websites, Discord bots, & more!"
	/>
</svelte:head>
<section
	class="fadeIn mt-20 flex flex-col items-center justify-between space-y-10 align-middle md:mt-28 lg:mt-40 lg:flex-row lg:space-y-0"
>
	<section class="w-full text-center md:space-y-6 lg:text-left">
		<div class="h-full space-y-4 lg:pr-10">
			<h1 class="h-28 text-5xl font-extrabold text-white sm:h-auto xl:text-6xl">
				{welcomeTextFinal}
			</h1>
			<h2 class="spacing text-3xl leading-10 text-gray-100 xl:text-4xl">
				My name is <span class="emphasis">Jordan</span>.
			</h2>
			<h2 class="spacing xl:text-4xls text-3xl leading-10 text-gray-100">
				I'm a <span class="emphasis">student</span> studying
				<span class="emphasis">informatics</span>
				at the <span class="emphasis">University of Washington</span>.
			</h2>
			<div class="space-x-5 text-center lg:text-left">
				{#each socials as social}
					<IconLink
						external={false}
						title={social.name}
						link={social.link}
						icon={social.icon + " fa-3x"}
					/>
				{/each}
			</div>
		</div>
	</section>
	<section class="w-full text-center">
		<div class="relative md:h-96">
			<img
				class="w-full sm:hidden"
				alt={statsInfo.imgDes}
				src={statsInfo.imgMobile}
			/>
			<img
				class="absolute bottom-0 left-0 right-0 top-0 hidden h-96 w-full sm:block"
				alt={statsInfo.imgDes}
				src={statsInfo.imgUrl}
			/>
		</div>
	</section>
</section>
<h1 class="my-16 text-center text-4xl font-extrabold text-white md:my-32 md:text-5xl">
	What I do...
</h1>
<div
	class="my-16 flex flex-col justify-between space-y-10 lg:my-32 lg:flex-row lg:space-x-10 lg:space-y-0"
>
	<Skillcard header="Server Infrastructure">
		To save money on hosting cost as a teenager, I began researching Linux and other technologies
		that enable websites and services to operate independently. I have experience with technologies
		such as Docker, Cloudflare, Nginx, Apache, MySQL, and the Digital Ocean cloud hosting platform.
	</Skillcard>
	<Skillcard header="Web Development">
		I first began working on websites during my freshman year of high school. I fell in love with
		the technology and have been striving to learn more ever since. I am highly proficient in PHP,
		JavaScript & Typescript, CSS, and frameworks such as Laravel, Svelte, and Vue. I also have
		experience using design frameworks such as Tailwind CSS, Bulma, and Bootstrap.
	</Skillcard>
	<Skillcard header="Discord Bots"
		>In my free time I like to create Discord bots as a hobby. I have experience writing them in
		Python, Java, and JavaScript/TypeScript. I primarily make them for fun or for use by my friends.
		The bots that I have made can do things such as playing music in a voice channel, image
		manipulation, and other utility commands.
	</Skillcard>
</div>
<section
	id="projects"
	class="my-16"
>
	<h1 class="py-16 text-center text-4xl font-extrabold text-white md:py-32 md:text-5xl">
		My Projects
	</h1>
	<Projects></Projects>
</section>
<hr id="contact" />
<section class="my-16">
	<div class="flex w-full flex-col content-center items-center justify-between lg:flex-row">
		<div class="space-y-4 lg:w-1/3">
			<h1 class="text-center text-4xl font-extrabold text-white md:text-5xl lg:text-left">
				Contact Me
			</h1>
			<p class="text-ju mx-4 text-center text-lg text-white lg:mx-0 lg:text-left lg:text-xl">
				Fill out this form to send a message directly to my inbox! No matter what you have to say, I
				would love to hear from you! Feedback on this website is also much appreciated. You can also
				reach me on Discord if that's your preferred method of communication, my username is <strong
					>driedsponge</strong
				>.
			</p>
		</div>
		<form
			class="relative my-8 w-full rounded-lg bg-bgsecondary p-8 lg:w-1/2"
			method="POST"
			use:enhance={() => {
				console.log("Submitting form...");
				return async ({ result, update }) => {
					solvedCaptcha = false;
					window.turnstile.reset(turnstileId);
					errors = result.data.error;
					if (!result.data.success && result.data.msg) {
						console.log(result.data.msg);
						errorMsg = result.data.msg;
					}
					if (result.data.success) {
						errors = {};
					}
					update();
				};
			}}
		>
			<div class="space-y-4">
				<div class="flex flex-col lg:flex-row lg:space-x-3">
					<label
						>Name<sup>*</sup>
						<input
							on:focusout={(event) => {
								validate("name", { name: event.target.value });
							}}
							maxlength="50"
							name="name"
							placeholder="Jane Doe"
							value={form?.name ?? ""}
							class:error={errors?.name}
						/>
						<span>
							<i class="fa-solid fa-triangle-exclamation"></i>
							{#if errors?.name}
								{errors.name}
							{/if}
						</span>
					</label>
					<label
						>Email<sup>*</sup>
						<input
							on:focusout={(event) => {
								validate("email", { email: event.target.value });
							}}
							maxlength="50"
							name="email"
							value={form?.email ?? ""}
							placeholder="name@example.com"
							class:error={errors?.email}
						/>
						<span>
							<i class="fa-solid fa-triangle-exclamation"></i>
							{#if errors?.email}
								{errors.email}
							{/if}
						</span>
					</label>
				</div>
				<label
					>Subject<sup>*</sup>
					<input
						on:focusout={(event) => {
							validate("subject", { subject: event.target.value });
						}}
						maxlength="100"
						name="subject"
						value={form?.subject ?? ""}
						placeholder="I wanted to chat about..."
						class:error={errors?.subject}
					/>
					<span>
						<i class="fa-solid fa-triangle-exclamation"></i>
						{#if errors?.subject}
							{errors.subject}
						{/if}
					</span>
				</label>
				<label
					>Message<sup>*</sup>
					<textarea
						on:focusout={(event) => {
							validate("message", { message: event.target.value });
						}}
						maxlength="1000"
						rows="6"
						name="message"
						class:error={errors?.message}
						placeholder="I just wanted to let you know you're a really cool person!"
						>{form?.message ?? ""}</textarea
					>
					<span>
						<i class="fa-solid fa-triangle-exclamation"></i>
						{#if errors?.message}
							{errors.message}
						{/if}
					</span>
				</label>
				<div
					class="flex flex-col content-center items-center space-y-3 md:flex-row md:space-x-3 md:space-y-0"
				>
					<div class="cf-turnstile"></div>
					{#if errorMsg}
						<p
							transition:fade
							class=" block text-center text-sm text-red-400 md:text-left"
						>
							{errorMsg}
						</p>
					{/if}
				</div>
				<button
					disabled={!solvedCaptcha || !(Object.keys(errors).length === 0)}
					title={solvedCaptcha ? "Submit" : "Awaiting Invisible Captcha Validation"}
					type="submit"><i class="fa-regular fa-paper-plane"></i> Send</button
				>
			</div>
			{#if form?.success}
				<div
					transition:fade
					class="absolute left-0 top-0 z-50 h-full w-full rounded-lg bg-bgsecondary p-8"
				>
					<div
						class="flex h-full flex-col content-center items-center justify-center space-y-8 align-middle"
					>
						<h1 class="text-center text-4xl font-extrabold text-green-400">Success!</h1>
						<p class="text-center text-2xl text-white">
							Your message was sent to me! Thanks for reaching out! I will try to get back to you
							within the next 24 hours!
						</p>
						<button
							type="reset"
							on:click={() => {
								form = null;
							}}>Submit another response!</button
						>
					</div>
				</div>
			{/if}
		</form>
	</div>
</section>

<style lang="postcss">
	.emphasis {
		@apply font-bold text-myblue;
	}

	.fadeIn {
		animation: fadeInAnimation ease 2s;
		animation-iteration-count: 1;
		animation-fill-mode: forwards;
	}

	@keyframes fadeInAnimation {
		0% {
			opacity: 0;
		}
		100% {
			opacity: 1;
		}
	}
	button:disabled {
		@apply bg-gray-500 hover:cursor-not-allowed hover:bg-gray-500;
	}
	button {
		@apply w-full rounded-lg bg-bgborder p-3 text-center text-white transition-all duration-200 ease-in-out hover:bg-myblue hover:shadow-2xl;
	}
	label {
		@apply my-2 block w-full text-white;
	}
	label > span {
		@apply invisible mt-1 block text-sm italic;
	}
	input,
	textarea {
		@apply my-1 block w-full rounded-md border-2 border-transparent p-2  text-black shadow-xl  transition-colors duration-200 ease-in-out focus:border-myblue focus:outline-none;
	}
	input.error,
	textarea.error {
		@apply border-2 border-red-400;
	}
	input.error + span,
	textarea.error + span {
		@apply visible text-red-400;
	}
</style>
