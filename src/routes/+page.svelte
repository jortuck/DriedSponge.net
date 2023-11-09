<script lang="ts">
	import IconLink from "$lib/IconLink.svelte";
	import { PUBLIC_EMAIL, PUBLIC_STATS_ENDPOINT } from "$env/static/public";
	import Skillcard from "$lib/Skillcard.svelte";
	import { onMount } from "svelte";
	import Shield from "$lib/Shield.svelte";
	import Project from "$lib/Project.svelte";

	const socials = [
		{
			link: "https://github.com/driedsponge",
			icon: "fa-brands fa-github",
			name: "Github"
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
	let welcomeTextFinal = "";
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
</script>

<svelte:head>
	<title>Jordan Tucker | Home</title>
	<meta
		name="description"
		content="Hello 👋, my name is Jordan. I'm a student at the University of Washington studying informatics who enjoys creating websites, Discord bots, & more."
	/>
	<meta
		property="og:title"
		content="Jordan Tucker | Home"
	/>
	<meta
		property="og:description"
		content="Hello 👋, my name is Jordan. I'm a student at the University of Washington studying informatics who enjoys creating websites, Discord bots, & more."
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
						external={true}
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
	class=" my-16 flex flex-col justify-between space-y-10 lg:my-32 lg:flex-row lg:space-x-10 lg:space-y-0"
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
<section id="projects">
	<h1 class="py-16 text-center text-4xl font-extrabold text-white md:py-32 md:text-5xl">
		My Projects
	</h1>
	<Project
		projectTitle="Freddy Bot"
		imageAlt="Image of freddy's discord profile."
		image="/projects/freddy.png"
		logos={[
			{ text: "Java", logoColor: "white", logo: "openjdk", color: "orange" },
			{ text: "Discord_API", logoColor: "", logo: "discord", color: "gray" }
		]}
		externalLinks={[
			{
				text: "Source Code",
				href: "https://github.com/driedsponge/freddy",
				faIcon: "fa-brands fa-github"
			},
			{
				text: "Test it out!",
				href: "https://discord.com/api/oauth2/authorize?client_id=914454054808211476&permissions=3230720&scope=bot",
				faIcon: "fa-brands fa-discord"
			}
		]}
	>
		This bot was created using Discord JDA (Java Discord API). I was inspired to make it after
		Google started cracking down on music bots that were using YouTube as an audio source. Because
		of this, my friends and I could no longer listen to music together in a discord call. While this
		bot I created still uses YouTube as an audio source, I doubt Google will send me a cease and
		desists because it's used personally, not commercially. The goal here is not to make money. My
		goal is to make it easy to self host, so people who need music in their Discord servers can have
		access to it.
	</Project>
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
</style>
