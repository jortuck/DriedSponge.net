<script lang="ts">
	export let icon: string;
	export let link: string;
	export let external: boolean = false;
	export let title: string;
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
