<script>
	export let icon;
	export let link;
	export let external = false;
	export let title;
</script>

<a
	href={link}
	{title}
	aria-label={title}
	target={external ? "_blank" : null}
	rel={external ? "noreferrer" : null}
	class="text-white transition-colors duration-200 ease-in-out hover:text-myblue"
>
	<i class={icon} />
</a>
