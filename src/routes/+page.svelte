<script>
	import { fade } from "svelte/transition";
</script>

<div
	class="mt-40 flex flex-row items-center justify-between"
	transition:fade={{ duration: 300 }}
>
	<section class="w-full space-y-4 text-center md:text-left">
		<h1 class="text-6xl font-extrabold text-white">Hello👋</h1>
		<h2 class="spacing text-4xl leading-10 text-gray-100">
			My name is <span class="emphasis">Jordan</span>
		</h2>
		<h2 class="spacing text-4xl leading-10 text-gray-100">
			Also known as <span class="emphasis">DriedSponge</span>
		</h2>
		<h2 class="spacing text-4xl leading-10 text-gray-100">
			I'm a <span class="text-myblue">Full Stack Web Developer</span>.
		</h2>
	</section>
	<section class="w-full space-y-2 text-center">
		<img
			class="w-full"
			alt="A graph showing my coding activity during the past week."
			src="https://github-readme-stats.vercel.app/api/wakatime?username=DriedSponge&theme=dark&bg_color=2B323B&hide_border=true&custom_title=Here's what I've been up to this week:&layout=compact&text_color=fff&border_radius=10"
		/>
	</section>
</div>

<style lang="postcss">
	.emphasis {
		@apply font-bold text-myblue;
	}
</style>
