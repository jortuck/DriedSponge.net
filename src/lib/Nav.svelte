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
	function evaluateScroll() {
		scrolled = window.scrollY > 0;
	}

	// Make sure scroll pos is checked when page is initially loaded.
	onMount(() => {
		evaluateScroll();
	});
</script>

<svelte:window on:scroll={evaluateScroll} />
<nav
	class="sticky top-0 flex border-b-bgborder py-4 transition-colors duration-200 ease-in-out"
	class:bg-bgsecondary={scrolled}
	class:border-b-2={scrolled}
>
	<div class="container mx-auto flex hidden max-w-6xl items-center justify-between md:flex">
		<div>
			<a
				class="text-3xl font-extrabold text-white"
				href="/"><span class="text-myblue">Dried</span>Sponge</a
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
	<div class="container mx-3 max-w-full md:hidden">
		<div class="flex items-center justify-between">
			<div>
				<a
					class="text-3xl font-extrabold text-white"
					href="/"><span class="text-myblue">D</span>S</a
				>
			</div>
			<div>
				<a
					href="#"
					class="text-white">[]</a
				>
			</div>
		</div>
	</div>
</nav>
