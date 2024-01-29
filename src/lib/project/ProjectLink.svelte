<script lang="ts">
	export let href: string;
	export let icon: string;
</script>

<a
	class="block rounded-lg bg-bgborder p-3 text-center text-white transition-all duration-200 ease-in-out hover:bg-myblue hover:shadow-2xl md:inline"
	rel="noopener"
	target="_blank"
	{href}><i class={icon}></i> <slot /></a
>
