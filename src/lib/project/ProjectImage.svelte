<script lang="ts">
	export let enhance: boolean = true;
	export let image: any;
	export let imageAlt: string | null;
</script>

{#if enhance}
	<div
		data-observe="lg:translate-x-[100px]"
		class="lg:w-1/2 lg:translate-x-[100px] lg:transition-transform lg:duration-1000 lg:ease-in-out"
	>
		<enhanced:img
			src={image}
			class="float-right w-full rounded-2xl shadow-2xl lg:w-auto lg:max-w-md xl:max-w-xl"
			alt={imageAlt}
			title={imageAlt}
		/>
	</div>
{:else}
	<div
		data-observe="lg:translate-x-[100px]"
		class="lg:w-1/2 lg:translate-x-[100px] lg:transition-transform lg:duration-1000 lg:ease-in-out"
	>
		<img
			src={image}
			class="float-right w-full rounded-2xl shadow-2xl lg:w-auto lg:max-w-md xl:max-w-xl"
			alt={imageAlt}
			title={imageAlt}
		/>
	</div>
{/if}
