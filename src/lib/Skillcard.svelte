<script lang="ts">
	export let header: string = "";
</script>

<div class="w-full rounded-lg bg-bgsecondary p-5">
	{#if header !== ""}
		<h1 class="text-center text-2xl font-bold text-white">{header}</h1>
	{/if}
	<p class="my-7 text-center text-lg text-gray-100">
		<slot />
	</p>
	<a
		href="/projects"
		class="group block rounded-lg bg-bgborder p-4 text-center text-white transition-all duration-200 ease-in-out hover:bg-myblue hover:shadow-2xl"
		>View Projects <i
			class="fa-solid fa-arrow-right transition-all duration-200 ease-in-out group-hover:translate-x-1.5"
		></i></a
	>
</div>
