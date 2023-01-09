<script>
	import Navlink from "$lib/Navlink.svelte";
</script>

<nav class="container mx-auto max-w-5xl py-4">
	<div class="flex items-center justify-between">
		<div>
			<a
				class="text-4xl font-extrabold text-white"
				href="/"><span class="text-myblue">D</span>S</a
			>
		</div>
		<div class="space-x-4">
			<Navlink href="/">Home</Navlink>
			<Navlink href="/projects">Projects</Navlink>
			<Navlink
				href="https://github.com/driedsponge"
				external="true">Github</Navlink
			>
		</div>
	</div>
</nav>
