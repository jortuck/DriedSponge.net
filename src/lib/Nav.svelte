<script>
	import Navlink from "$lib/Navlink.svelte";
	import { onMount } from "svelte";
	const links = [
		{
			href: "/",
			title: "Home",
			external: false
		},
		{
			href: "/projects",
			title: "Projects",
			external: false
		},
		{
			href: "https://github.com/driedsponge",
			title: "Github",
			external: true
		}
	];
	let scrolled = false;
	let expanded = false;
	function evaluateScroll() {
		scrolled = window.scrollY > 0;
	}

	// Make sure scroll pos is checked when page is initially loaded.
	onMount(() => {
		evaluateScroll();
	});
</script>

<svelte:window on:scroll={evaluateScroll} />
<div class="sticky top-0 z-10">
	<nav
		class="flex border-b-2 border-b-bgborder bg-bgsecondary py-4 transition-colors duration-200 ease-in-out lg:border-0 lg:bg-transparent"
		class:scrolled
	>
		<div
			class="max-w-8xl container mx-auto flex hidden items-center justify-between px-2 lg:flex xl:px-0"
		>
			<div>
				<a
					class="text-3xl font-extrabold text-white"
					href="/"><span class="text-myblue">Jordan</span>Tucker</a
				>
			</div>
			<div class="space-x-10">
				{#each links as link}
					<Navlink
						external={link.external}
						href={link.href}>{link.title}</Navlink
					>
				{/each}
			</div>
		</div>
		<div class="container mx-3 max-w-full transition-all duration-200 ease-in-out lg:hidden">
			<div class="flex items-center justify-between">
				<div>
					<a
						class="text-3xl font-extrabold text-white"
						href="/"><span class="text-myblue">J</span>T</a
					>
				</div>

				<div>
					<a
						on:click={() => {
							expanded = !expanded;
						}}
						class="text-white"
						role="button"
					>
						<img
							class="w-6"
							class:hidden={!expanded}
							src="/icons/cross.svg"
							alt="Menu Button"
						/>
						<img
							class:hidden={expanded}
							class="w-6"
							src="/icons/menu-burger.svg"
							alt="Menu Button"
						/>
					</a>
				</div>
			</div>
			<div />
		</div>
	</nav>
	<div
		class:scale-y-0={!expanded}
		class="absolute z-10 w-full origin-top bg-bgsecondary transition-all duration-200 ease-in-out lg:hidden"
	>
		<ul class="space-y-4 py-4 text-center">
			{#each links as link}
				<li>
					<Navlink
						on:click={() => {
							expanded = false;
						}}
						external={link.external}
						href={link.href}>{link.title}</Navlink
					>
				</li>
			{/each}
		</ul>
	</div>
</div>

<style lang="postcss">
	.scrolled {
		@apply border-b-2 bg-bgsecondary;
	}
</style>
