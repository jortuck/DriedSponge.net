<script setup lang="ts">
import { ref } from "vue";
import { useWindowScroll } from "@vueuse/core";
let scroll = ref(0);
onMounted(()=>{
	let {x, y} = useWindowScroll();
	watch(y, (value) => {
		scroll.value = value;
	});
})
</script>
<template>
	<nav
		class="lg:flex hidden border-b-2 border-b-base-200 bg-base-100 py-4 transition-colors duration-200 ease-in-out lg:border-0 lg:bg-transparent"
		:class="{'scrolled':scroll > 0}"
	>
		<div
			class="max-w-8xl container mx-auto hidden items-center justify-between px-2 lg:flex xl:px-0"
		>
			<div>
				<a
					class="text-3xl font-extrabold text-white"
					href="/"><span class="text-primary">Jordan</span> Tucker</a
				>
			</div>
			<div class="links space-x-10">
				<a
					href="/"
				>
					Home
				</a>
				<a
					href="#projects"
				>
					Projects
				</a>
				<a
					href="#contact"
				>
					Contact
				</a>
				<a
					href="/blog"
				>
					Blog
				</a>
			</div>
		</div>
	</nav>
</template>
<style scoped lang="postcss">
.scrolled {
	@apply border-b-2 bg-base-100;
}
div.links > a {
	@apply text-xl text-gray-400 transition-colors duration-200 ease-in-out hover:text-white
}
</style>
