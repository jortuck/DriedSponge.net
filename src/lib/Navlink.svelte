<script>
	export let href = "/";
	export let external = false;
	export let active = false;
</script>

<a
	class="text-xl transition-colors duration-200 ease-in-out hover:text-white"
	on:click
	class:text-white={active}
	class:text-gray-400={!active}
	{href}
	rel={external ? "noopener" : null}
	target={external ? "_blank" : null}
>
	<slot />
</a>
