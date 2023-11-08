<script lang="ts">
	export let host: string;
	export let alt: string;
	export let title: string;
</script>

<img
	class="hidden w-full sm:block"
	{alt}
	src="https://{host}/api?username=driedsponge&include_all_commits=true&hide_border=true&layout=compact&theme=dark&bg_color=2B323B&border_radius=10&custom_title={title}&show_icons=true&icon_color=62a1ec"
/>
