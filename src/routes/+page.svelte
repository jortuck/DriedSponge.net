<script lang="ts">
	import IconLink from "$lib/IconLink.svelte";
	import { page } from "$app/stores";
	import { fade } from "svelte/transition";
	import {
		PUBLIC_API_HOST,
		PUBLIC_STATS_ENDPOINT,
		PUBLIC_TURNSTILE_SITE_KEY
	} from "$env/static/public";
	import { enhance, applyAction } from "$app/forms";
	import Skillcard from "$lib/Skillcard.svelte";
	import { onMount } from "svelte";
	import type { PageData, ActionData } from "./$types";
	import { contactSchema } from "$lib/Validator";
	import Input from "$lib/Input.svelte";
	import Textarea from "$lib/Textarea.svelte";
	import Project from "$lib/project/Project.svelte";
	import ProjectImage from "$lib/project/ProjectImage.svelte";
	import Shield from "$lib/Shield.svelte";
	export let data: PageData;
	export let form: ActionData;

	const socials = [
		{
			link: "https://github.com/jortuck",
			icon: "fa-brands fa-github",
			name: "GitHub"
		}
	];
	let welcomeText: string = "Hello";
	let welcomeTextFinal: string = "";
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

	let errors: any = {};
	let solvedCaptcha: boolean = false;
	let loading: boolean = false;
	let turnstileId: any;
	let showSuccess: boolean = false;
	let errorMsg: string = "";
	onMount(() => {
		// @ts-ignore
		window.turnstile.ready(function () {
			// @ts-ignore
			turnstileId = window.turnstile.render(".cf-turnstile", {
				sitekey: PUBLIC_TURNSTILE_SITE_KEY,
				callback: function (token: string) {
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
	async function validate(field: string, value: any) {
		try {
			await contactSchema.validateAt(field, value);
			if (errors[field]) {
				errors[field] = null;
				delete errors[field];
			}
		} catch (e: any) {
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
		content="Hello 👋, my name is Jordan. I'm a student at the University of Washington studying Informatics. I enjoy creating websites, Discord bots, & more!"
	/>
	<meta
		property="og:title"
		content="Jordan Tucker | Home"
	/>
	<meta
		property="og:description"
		content="Hello 👋, my name is Jordan. I'm a student at the University of Washington studying Informatics. I enjoy creating websites, Discord bots, & more!"
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
				<span class="emphasis">Informatics</span>
				at the <span class="emphasis">University of Washington</span>.
			</h2>
			<div class="space-x-5 text-center lg:text-left">
				{#each socials as social}
					<IconLink
						external={true}
						title={social.name}
						link={social.link}
						icon={social.icon + " fa-3x"}
					/>
				{/each}
				<IconLink
					external={false}
					title="Send me a message!"
					link="#contact"
					icon="fa-solid fa-envelope fa-3x"
				/>
			</div>
		</div>
	</section>
	<section class="w-full text-center">
		<div class="relative md:h-96">
			<img
				class="w-full sm:hidden"
				alt="My GitHub Stats"
				src="{PUBLIC_STATS_ENDPOINT}?username=jortuck&include_all_commits=true&hide_border=true&layout=compact&theme=dark&bg_color=2B323B&border_radius=10&cache_seconds=21600&custom_title=My GitHub Stats&show_icons=true&icon_color=62a1ec&hide_rank=true&card_width=290"
			/>
			<img
				class="absolute bottom-0 left-0 right-0 top-0 hidden h-96 w-full sm:block"
				alt="My GitHub Stats"
				src="{PUBLIC_STATS_ENDPOINT}?username=jortuck&include_all_commits=true&hide_border=true&layout=compact&theme=dark&bg_color=2B323B&border_radius=10&cache_seconds=21600&custom_title=My GitHub Stats&show_icons=true&icon_color=62a1ec"
			/>
		</div>
	</section>
</section>
<h1
	data-observe="fadeUp"
	class="fadeUp my-16 text-center text-4xl font-extrabold text-white transition-all duration-1000 ease-in-out md:my-32 md:text-5xl"
>
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
	<h1
		data-observe="fadeUp"
		class="fadeUp py-16 text-center text-4xl font-extrabold text-white transition-all duration-1000 ease-in-out md:py-32 md:text-5xl"
	>
		My Projects
	</h1>
	{#each data.projects as project}
		<Project
			let:Links
			let:Description
			let:Header
		>
			<Header
				let:Title
				let:Shields
			>
				<Title>
					{project.attributes.title}
				</Title>
				<Shields repository={project.attributes.github}>
					{#each project.attributes.technology as technology}
						<Shield
							text={technology.name}
							logo={technology.logo}
							color={technology.color}
							logoColor={technology.logoColor}
						/>
					{/each}
				</Shields>
			</Header>
			<Description>
				{#each project.attributes.body[0].children as bodyPart}
					{#if bodyPart.type === "text"}
						{bodyPart.text}
					{:else if bodyPart.type === "link"}
						<a
							target="_blank"
							rel="noopener"
							href={bodyPart.url}>{bodyPart.children[0].text}</a
						>
					{/if}
				{/each}
			</Description>
			<Links let:Link>
				{#if project.attributes.github}
					<Link
						icon="fa-brands fa-github"
						href={`https://github.com/jortuck/${project.attributes.github}`}
					>
						Source Code
					</Link>
				{/if}
				{#each project.attributes.links as link}
					<Link
						icon={link.icon}
						href={link.url}
					>
						{link.text}
					</Link>
				{/each}
			</Links>
			<ProjectImage
				slot="image"
				enhance={false}
				image={PUBLIC_API_HOST + project.attributes.thumbnail.data.attributes.url}
				imageAlt={PUBLIC_API_HOST + project.attributes.thumbnail.data.attributes.alt}
			/>
		</Project>
	{/each}
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
			action="/contactapi"
			class="relative my-8 w-full rounded-lg bg-bgsecondary p-8 lg:w-1/2"
			method="POST"
			use:enhance={() => {
				loading = true;
				console.log("Submitting form...");
				return async ({ result, update }) => {
					loading = false;
					solvedCaptcha = false;
					if (result.type === "success") {
						update({ reset: true, invalidateAll: true });
						showSuccess = true;
					} else {
						applyAction(result);
					}
					//@ts-ignore
					window.turnstile.reset(turnstileId);
				};
			}}
		>
			<div class="space-y-4">
				<div class="flex flex-col lg:flex-row lg:space-x-3">
					<Input
						error={$page.form?.error?.name || errors["name"]}
						label="Name"
						required={true}
						maxLength={50}
						name="name"
						placeHolder="Jane Doe"
						on:validate={(event) => {
							validate("name", { name: event.detail });
						}}
					/>
					<Input
						error={$page.form?.error?.email || errors["email"]}
						label="Email"
						required={true}
						maxLength={50}
						name="email"
						placeHolder="name@example.com"
						on:validate={(event) => {
							validate("email", { email: event.detail });
						}}
					/>
				</div>
				<Input
					error={$page.form?.error?.subject || errors["subject"]}
					label="Subject"
					required={true}
					maxLength={100}
					name="subject"
					placeHolder="I wanted to chat about..."
					on:validate={(event) => {
						validate("subject", { subject: event.detail });
					}}
				/>
				<Textarea
					error={$page.form?.error?.message || errors["message"]}
					name="message"
					label="Message"
					placeHolder="I just wanted to let you know you're a really cool person!"
					maxLength={1000}
					rows={6}
					required={true}
					on:validate={(event) => {
						validate("message", { message: event.detail });
					}}
				/>
				<div
					class="flex flex-col content-center items-center space-y-3 md:flex-row md:space-x-3 md:space-y-0"
				>
					<div class="cf-turnstile"></div>
					{#if $page.form?.msg || errorMsg}
						<p
							transition:fade
							class=" block text-center text-sm text-red-400 md:text-left"
						>
							{$page.form?.msg || errorMsg}
						</p>
					{/if}
				</div>
				<!--					-->

				<button
					disabled={!solvedCaptcha || !(Object.keys(errors).length === 0) || loading}
					title={solvedCaptcha ? "Submit" : "Awaiting Invisible Captcha Validation"}
					type="submit"
				>
					{#if loading}
						<i class="fa-solid fa-spinner fa-spin"></i>
					{:else}
						<i class="fa-regular fa-paper-plane"></i>
					{/if}
					Send</button
				>
			</div>
			{#if showSuccess}
				<div
					transition:fade
					class="absolute left-0 top-0 z-40 h-full w-full rounded-lg bg-bgsecondary p-8"
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
							on:click={() => (showSuccess = false)}
							type="reset">Submit another response!</button
						>
					</div>
				</div>
			{/if}
		</form>
	</div>
</section>

<style lang="postcss">
	.fadeUp {
		@apply translate-y-[100px] opacity-0 lg:translate-y-[200px];
	}
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
	a {
		@apply text-myblue hover:underline;
	}
</style>
