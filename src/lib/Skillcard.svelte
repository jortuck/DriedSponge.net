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
</div>
