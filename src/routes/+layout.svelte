<script lang="ts">
	import "../app.css";
	import Nav from "$lib/Nav.svelte";
	import Footer from "$lib/Footer.svelte";
</script>

<div class="flex h-full flex-col">
	<Nav />
	<main class="max-w-8xl container mx-auto flex-1 px-3 xl:px-0">
		<slot />
	</main>
	<Footer />
</div>
