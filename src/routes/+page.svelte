<script>
	import IconLink from "$lib/IconLink.svelte";
	import { PUBLIC_EMAIL, PUBLIC_STATS_ENDPOINT } from "$env/static/public";
	import Card from "$lib/Card.svelte";
	import { onMount } from "svelte";
	import { fade } from "svelte/transition";
	const socials = [
		{
			link: "https://github.com/driedsponge",
			icon: "fa-brands fa-github"
		},
		{
			link: "https://steamcommunity.com/id/driedsponge/",
			icon: "fa-brands fa-steam"
		},
		{
			link: `mailto:${PUBLIC_EMAIL}`,
			icon: "fa-regular fa-envelope"
		}
	];
	let gallery = [
		{
			imgUrl: `${PUBLIC_STATS_ENDPOINT}/top-langs?username=driedsponge&include_all_commits=true&hide_border=true&layout=compact&theme=dark&bg_color=2B323B&border_radius=10&custom_title=My Top Languages`,
			imgDes: "My Top languages",
			imgMobile: `${PUBLIC_STATS_ENDPOINT}/top-langs?username=driedsponge&include_all_commits=true&hide_border=true&theme=dark&bg_color=2B323B&border_radius=10&custom_title=My Top Languages`
		},
		{
			imgUrl: `${PUBLIC_STATS_ENDPOINT}?username=driedsponge&include_all_commits=true&hide_border=true&layout=compact&theme=dark&bg_color=2B323B&border_radius=10&custom_title=My Github Stats&show_icons=true&icon_color=62a1ec`,
			imgDes: "My Github Stats",
			imgMobile: `${PUBLIC_STATS_ENDPOINT}?username=driedsponge&include_all_commits=true&hide_border=true&layout=compact&theme=dark&bg_color=2B323B&border_radius=10&custom_title=My Github Stats&show_icons=true&icon_color=62a1ec&hide_rank=true&card_width=290`
		}
	];
	let stats = false;
	let statsInfo = gallery[0];
	onMount(() => {
		setInterval(function () {
			stats = !stats;
			if (stats) {
				statsInfo = gallery[1];
			} else {
				statsInfo = gallery[0];
			}
		}, 10000);
	});
</script>

<svelte:head>
	<title>DriedSponge.net | README.md</title>
</svelte:head>
<div
	class="mt-28 flex flex-col items-center justify-between space-y-10 align-middle lg:mt-40 lg:flex-row lg:space-y-0"
>
	<section class="w-full space-y-4 text-center lg:text-left">
		<h1 class="text-5xl font-extrabold text-white xl:text-6xl">Hello👋</h1>
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
					link={social.link}
					icon={social.icon + " fa-3x"}
				/>
			{/each}
		</div>
	</section>
	<section class="w-full text-center">
		<div class="relative h-96">
			{#key statsInfo}
				<img
					in:fade={{ duration: 1500, delay: 1800 }}
					out:fade={{ duration: 1500 }}
					class="w-full sm:hidden"
					alt={statsInfo.imgDes}
					src={statsInfo.imgMobile}
				/>
				<img
					in:fade={{ duration: 1000, delay: 1300, create: false }}
					out:fade={{ duration: 1000 }}
					class="absolute top-0 right-0 bottom-0 left-0 hidden h-96 w-full sm:block"
					alt={statsInfo.imgDes}
					src={statsInfo.imgUrl}
				/>
			{/key}
		</div>
	</section>
</div>
<!--<div class="mt-32 flex flex-row justify-between space-x-10">-->
<!--	<Card>-->
<!--		<h1 class="text-center text-white">Discord Bots</h1>-->
<!--	</Card>-->
<!--	<Card>-->
<!--		<h1 class="text-center text-white">Web Development</h1>-->
<!--	</Card>-->
<!--	<Card>-->
<!--		<h1 class="text-center text-white">Server Infrastructure</h1>-->
<!--	</Card>-->

<!--</div>-->
<style lang="postcss">
	.emphasis {
		@apply font-bold text-myblue;
	}
</style>
