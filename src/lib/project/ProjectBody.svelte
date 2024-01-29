<script lang="ts">
	import Links from "$lib/project/ProjectLinks.svelte";
	import Description from "$lib/project/ProjectDescription.svelte";
	import Header from "$lib/project/ProjectHeader.svelte";
</script>

<div
	data-observe="lg:-translate-x-[100px]"
	class="space-y-3 lg:w-1/2 lg:-translate-x-[100px] lg:transition-transform lg:duration-[1500ms] lg:ease-in-out"
>
	<slot
		{Links}
		{Description}
		{Header}
	/>
</div>
