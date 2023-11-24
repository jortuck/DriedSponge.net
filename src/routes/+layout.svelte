<script lang="ts">
	import "../app.css";
	import Nav from "$lib/Nav.svelte";
	import Footer from "$lib/Footer.svelte";
	import { onMount } from "svelte";
	onMount(() => {
		const observer = new IntersectionObserver(
			(entries) => {
				entries.forEach((entry) => {
					if (entry.isIntersecting) {
						entry.target.classList.remove(entry.target.getAttribute("data-observe") ?? "");
						observer.unobserve(entry.target);
					}
				});
			},
			{
				threshold: 0.2
			}
		);
		let entries = document.querySelectorAll("[data-observe]");
		entries.forEach((entry) => {
			observer.observe(entry);
		});
	});
</script>

<div class="flex h-full flex-col">
	<Nav />
	<main class="max-w-8xl container mx-auto flex-1 px-3 xl:px-0">
		<slot />
	</main>
	<Footer />
</div>
