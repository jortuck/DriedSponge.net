<script>
	import "../app.css";
	import Nav from "$lib/Nav.svelte";
	import * as AOS from "aos";
	// import "@fortawesome/fontawesome-free/js/fontawesome.min";
	// import "@fortawesome/fontawesome-free/js/brands.min";
	// import "@fortawesome/fontawesome-free/js/regular.min";

	import "aos/dist/aos.css";
	import { onMount } from "svelte";
	import { browser } from "$app/environment";

	let hideBanner = true;

	onMount(() => {
		// TODO: Switch to svelte transitions once they allow for animations on load!
		if (browser) {
			AOS.init();
			window.AOS = AOS;
		}

		if (!localStorage.getItem("hideBanner")) {
			hideBanner = false;
		}
	});

	function dismiss() {
		hideBanner = true;
		localStorage.setItem("hideBanner", "true");
	}
</script>

{#if !hideBanner}
	<div
		class="bg-amber-700 p-4 text-center"
		data-aos="fade-down"
	>
		<p class=" font-extrabold text-white">
			This website is still a work in progress. Follow the development at the <a
				class="underline transition-colors duration-200 ease-in-out hover:text-gray-300"
				target="_blank"
				rel="noreferrer"
				href="https://github.com/driedsponge/DriedSponge.net">GitHub repo</a
			>.
			<span
				on:click={dismiss}
				class="float-none cursor-pointer font-extrabold transition-colors duration-200 ease-in-out hover:text-gray-300 md:float-right"
				title="Dismiss"
			>
				<i class="fa-solid fa-x fa-xl" />
			</span>
		</p>
	</div>
{/if}
<Nav />
<div class="max-w-8xl container mx-auto px-3 xl:px-0">
	<slot />
</div>
