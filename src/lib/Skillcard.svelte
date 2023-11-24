<script lang="ts">
	export let header: string = "";
</script>

<div
	data-observe="fadeUp"
	class="fadeUp relative w-full rounded-lg bg-bgsecondary p-5 transition-all duration-[1500ms] ease-in-out"
>
	{#if header !== ""}
		<h1 class="text-center text-2xl font-bold text-white">{header}</h1>
	{/if}
	<p class="relative my-7 text-center text-lg text-gray-100">
		<slot />
	</p>
</div>

<style lang="postcss">
	.fadeUp {
		@apply opacity-0 lg:translate-y-[200px];
	}
</style>
