<script>
	import { page } from "$app/stores";
	export let href = "/";
	export let external = false;
	let active = false;
	$: {
		active = $page.route.id === href;
	}
</script>

<a
	class="text-xl transition-colors duration-200 ease-in-out hover:text-white"
	on:click
	class:text-white={active}
	class:text-gray-300={!active}
	{href}
	rel={external ? "noopener" : null}
	target={external ? "_blank" : null}
>
	<slot />
</a>
