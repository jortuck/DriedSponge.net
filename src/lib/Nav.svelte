<script>
	import Navlink from "$lib/Navlink.svelte";
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
</script>

<nav class="border-b-2 border-b-myblue py-4 md:border-0">
	<div class="flex hidden items-center justify-between md:flex">
		<div>
			<a
				class="text-3xl font-extrabold text-white"
				href="/"><span class="text-myblue">Dried</span>Sponge</a
			>
		</div>
		<div class="space-x-4">
			{#each links as link}
				<Navlink
					external={link.external}
					href={link.href}>{link.title}</Navlink
				>
			{/each}
		</div>
	</div>
	<div class="mx-3 flex flex justify-between md:hidden">
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
</nav>
<div class="absolute top-0 z-10 h-screen">Test</div>
