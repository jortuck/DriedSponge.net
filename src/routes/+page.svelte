<script lang="ts">
	import IconLink from "$lib/IconLink.svelte";
	import { PUBLIC_EMAIL, PUBLIC_STATS_ENDPOINT } from "$env/static/public";
	import Skillcard from "$lib/Skillcard.svelte";
	import { onMount } from "svelte";

	const socials = [
		{
			link: "https://github.com/driedsponge",
			icon: "fa-brands fa-github",
			name: "Github"
		},
		{
			link: "https://steamcommunity.com/id/driedsponge/",
			icon: "fa-brands fa-steam",
			name: "Steam"
		},
		{
			link: `mailto:${PUBLIC_EMAIL}`,
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
	let welcomeText = "Hello";
	onMount(() => {
		const timeOfDay = new Date().getHours();
		if (timeOfDay >= 6 && timeOfDay < 12) {
			welcomeText = "Good Morning!";
		} else if (timeOfDay >= 12 && timeOfDay < 18) {
			welcomeText = "Good Afternoon!";
		} else if (timeOfDay >= 18 && timeOfDay < 22) {
			welcomeText = "Good Evening!";
		} else {
			welcomeText = "Sup, you're up late";
		}
	});
</script>

<svelte:head>
	<title>Jordan Tucker | Home</title>
	<meta
		name="description"
		content="Hello 👋, my name is Jordan. I'm a full stack web developer who enjoys creating websites and Discord bots."
	/>
	<meta
		property="og:title"
		content="Jordan Tucker | Home"
	/>
	<meta
		property="og:description"
		content="Hello 👋, my name is Jordan. I'm a full stack web developer who enjoys creating websites and Discord bots."
	/>
</svelte:head>
<div
	class="fadeIn mt-28 flex flex-col items-center justify-between space-y-10 align-middle lg:mt-40 lg:flex-row lg:space-y-0"
>
	<section class="w-full space-y-4 text-center lg:text-left">
		<h1 class="text-5xl font-extrabold text-white xl:text-6xl">
			{welcomeText}
		</h1>
		<h2 class="spacing text-3xl leading-10 text-gray-100 xl:text-4xl">
			My name is <span class="emphasis">Jordan</span>
		</h2>
		<h2 class="spacing text-3xl leading-10 text-gray-100 xl:text-4xl">
			I'm a <span class="emphasis">Full Stack Web Developer</span>
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
</div>
<h1 class="my-16 text-center text-4xl font-extrabold text-white md:my-32 md:text-5xl">
	What I do...
</h1>
<div
	class="my-16 flex flex-col justify-between space-y-10 md:my-32 md:flex-row md:space-x-10 md:space-y-0"
>
	<Skillcard header="Discord Bots">
		Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
		labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
		laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
	</Skillcard>
	<Skillcard header="Web Development">
		Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
		labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
		laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
	</Skillcard>
	<Skillcard header="Server Infrastructure">
		Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
		labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
		laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
	</Skillcard>
</div>

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
</style>
