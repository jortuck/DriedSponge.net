<script>
	import IconLink from "$lib/IconLink.svelte";
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
			link: "mailto:jordan@driedsponge.net",
			icon: "fa-regular fa-envelope"
		}
	];
	const copyDiscord = async () => {
		let discord = "DriedSponge#4730";
		await navigator.clipboard.writeText(discord);
	};
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
		<img
			class="w-full sm:hidden"
			alt="My Github Stats"
			src="https://stats.driedsponge.net/api?username=driedsponge&include_all_commits=true&hide_border=true&layout=compact&theme=dark&bg_color=2B323B&border_radius=10&custom_title=My Github Stats&show_icons=true&icon_color=62a1ec&hide_rank=true&card_width=290"
		/>
		<img
			class="hidden w-full sm:block"
			alt="My Github Stats"
			src="https://stats.driedsponge.net/api?username=driedsponge&include_all_commits=true&hide_border=true&layout=compact&theme=dark&bg_color=2B323B&border_radius=10&custom_title=My Github Stats&show_icons=true&icon_color=62a1ec"
		/>
	</section>
</div>

<style lang="postcss">
	.emphasis {
		@apply font-bold text-myblue;
	}
</style>
