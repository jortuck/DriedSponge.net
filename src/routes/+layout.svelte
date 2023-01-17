<script>
	import "../app.css";
	import Nav from "$lib/Nav.svelte";
	import * as AOS from "aos";
	import "aos/dist/aos.css";
	import { onMount } from "svelte";
	import { browser } from "$app/environment";

	onMount(() => {
		// TODO: Switch to svelte transitions once they allow for animations on load!
		if (browser) {
			AOS.init();
			window.AOS = AOS;
		}
	});
</script>

<Nav />
<div class="max-w-8xl container mx-auto px-2 xl:px-0">
	<slot />
</div>
