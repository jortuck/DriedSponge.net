<script lang="ts">
	import Shield from "$lib/Shield.svelte";
	export let repository: string | null;
</script>

<div class="flex w-full flex-row flex-wrap justify-center gap-x-3 lg:justify-normal">
	{#if repository}
		<img
			class="my-1 rounded-md"
			alt="GitHub commit activity for {repository}"
			src="https://shields.driedsponge.net/github/commit-activity/t/driedsponge/{repository}?style=for-the-badge&logo=github"
		/>
	{/if}
	<slot />
</div>
