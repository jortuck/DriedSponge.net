<script lang="ts">
	import Description from "$lib/project/ProjectDescription.svelte";
	import Links from "$lib/project/ProjectLinks.svelte";
	import Header from "$lib/project/ProjectHeader.svelte";
</script>

<div
	data-observe="opacity-0"
	class="my-8 rounded-lg bg-bgsecondary px-4 py-8 opacity-0 transition-opacity duration-1000 ease-in-out lg:bg-transparent"
>
	<div class="flex flex-col content-center items-center space-y-10 lg:flex-row lg:space-y-0">
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
		<slot name="image" />
	</div>
</div>
